# This file is part of the Zephir Parser.
#
# (c) Zephir Team <team@zephir-lang.com>
#
# For the full copyright and license information, please view
# the LICENSE file that was distributed with this source code.

Function InitializeBuildVars {
	switch ($Env:VC_VERSION) {
		'14' {
			If (-not (Test-Path $Env:VS120COMNTOOLS)) {
				Throw 'The VS120COMNTOOLS environment variable is not set. Check your MS VS installation'
			}
			$Env:VSCOMNTOOLS = $Env:VS120COMNTOOLS
			break
		}
		'15' {
			If (-not (Test-Path $Env:VS140COMNTOOLS)) {
				Throw 'The VS140COMNTOOLS environment variable is not set. Check your MS VS installation'
			}
			$Env:VSCOMNTOOLS = $Env:VS140COMNTOOLS
			break
		}
		'16' {
			If (-not (Test-Path $Env:VS150COMNTOOLS)) {
				Throw 'The VS150COMNTOOLS environment variable is not set. Check your MS VS installation'
			}
			$Env:VSCOMNTOOLS = $Env:VS150COMNTOOLS
			break
		}
		default {
			Throw 'This script is designed to run with MS VS 14/15/16. Check your MS VS installation'
			break
		}
	}

	If ($Env:PLATFORM -eq 'x64') {
		$Env:ARCH = 'x86_amd64'
	} Else {
		$Env:ARCH = 'x86'
	}
}

Function InitializeReleaseVars {
	If ($Env:BUILD_TYPE -Match "nts-Win32") {
		$Env:RELEASE_ZIPBALL = "zephir_parser_${Env:PLATFORM}_vc${Env:VC_VERSION}_php${Env:PHP_VERSION}-nts_${Env:APPVEYOR_BUILD_VERSION}"

		If ($Env:PLATFORM -eq 'x86') {
			$Env:RELEASE_FOLDER = "Release"
		} Else {
			$Env:RELEASE_FOLDER = "x64\Release"
		}
	} Else {
		$Env:RELEASE_ZIPBALL = "zephir_parser_${Env:PLATFORM}_vc${Env:VC_VERSION}_php${Env:PHP_VERSION}_${Env:APPVEYOR_BUILD_VERSION}"

		If ($Env:PLATFORM -eq 'x86') {
			$Env:RELEASE_FOLDER = "Release_TS"
		} Else {
			$Env:RELEASE_FOLDER = "x64\Release_TS"
		}
	}

	$Env:RELEASE_PATH = "${Env:APPVEYOR_BUILD_FOLDER}\${Env:RELEASE_FOLDER}"
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
