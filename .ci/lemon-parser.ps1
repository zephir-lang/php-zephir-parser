Write-Output "-- Compiling Lemon parser..."
$LemonSrc = Join-Path -Path './parser' -ChildPath 'lemon.c'
$LemonBin = Join-Path -Path './parser' -ChildPath 'lemon.exe'

if ($IsWindows) {
	& cl /Fe${LemonExe} ${LemonSrc}
}
else {
	$LemonBin = Join-Path -Path './parser' -ChildPath 'lemon'
	& gcc ${LemonSrc} -o ${LemonBin}
}
& ${LemonBin} -x

Write-Output "-- Cleanup initial file state..."

$AutoFiles = "./parser/zephir.c",
			 "./parser/zephir.h",
        	 "./parser/parser.c",
        	 "./parser/scanner.c"

foreach ($GeneratedFile in $AutoFiles) {
	if (Test-Path -Path $GeneratedFile) {
		Remove-Item $GeneratedFile
	}
}

Write-Output "-- Run re2c..."
& re2c -o (Join-Path -Path './parser' -ChildPath 'scanner.c') (Join-Path -Path './parser' -ChildPath 'scanner.re')

Write-Output "-- Generating zephir.c file with lemon parser..."
& ${LemonBin} -s (Join-Path -Path './parser' -ChildPath 'zephir.lemon')

Write-Output "-- Generating parser.c file..."
$ParserC = Join-Path -Path './parser' -ChildPath 'parser.c'
$ZephirC = Join-Path -Path './parser' -ChildPath 'zephir.c'
$BaseC   = Join-Path -Path './parser' -ChildPath 'base.c'
Set-Content -Path ${ParserC} -Value '#include <php.h>'
Get-Content ${ZephirC}, ${BaseC} | Add-Content ${ParserC}
