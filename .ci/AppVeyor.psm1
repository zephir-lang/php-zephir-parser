# This file is part of the Zephir Parser.
#
# (c) Zephir Team <team@zephir-lang.com>
#
# For the full copyright and license information, please view
# the LICENSE file that was distributed with this source code.

Function InitializeBuildVars {
	If ($Env:PLATFORM -eq 'x64') {
		$Env:ARCH = 'x86_amd64'
	} Else {
		$Env:ARCH = 'x86'
	}
}

Function AppendSessionPath {
	[string[]] $PathsCollection = @(
		"${Env:VSCOMNTOOLS}\..\..\VC",
		"C:\Program Files (x86)\Microsoft Visual Studio ${Env:VC_VERSION}.0\VC",
		"C:\Program Files (x86)\Microsoft Visual Studio ${Env:VC_VERSION}.0\VC\bin",
		"${Env:VSCOMNTOOLS}",
		"C:\php"
		"C:\php\bin"
		"C:\php-sdk\bin",
		"C:\php-devpack"
	)

	$CurrentPath = (Get-Item -Path ".\" -Verbose).FullName

	ForEach ($PathItem In $PathsCollection) {
		Set-Location Env:
		$AllPaths = (Get-ChildItem Path).value.split(";")  | Sort-Object -Unique
		$AddToPath = $true

		ForEach ($AddedPath In $AllPaths) {
			If (-not "${AddedPath}") {
				continue
			}

			$AddedPath = $AddedPath -replace '\\$', ''

			If ($PathItem -eq $AddedPath) {
				$AddToPath = $false
			}
		}

		If ($AddToPath) {
			$Env:Path += ";$PathItem"
		}
	}

	Set-Location "${CurrentPath}"
}
