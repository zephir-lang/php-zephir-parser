# This file is part of the Zephir Parser.
#
# (c) Zephir Team <team@zephir-lang.com>
#
# For the full copyright and license information, please view
# the LICENSE file that was distributed with this source code.

function SetupCommonEnvironment {
    <#
        .SYNOPSIS
            Creates common directories if not exists
    #>

    $CommonPath = "C:\Downloads", "C:\Downloads\Choco"

    foreach ($path in $CommonPath) {
        if (-not (Test-Path $path)) {
            New-Item -ItemType Directory -Force -Path $path | Out-Null
        }
    }

    # Hide "You are in 'detached HEAD' state" message
    git config --global advice.detachedHead false
}

Function InitializeReleaseVars {
	If ($Env:BUILD_TYPE -Match "nts") {
		$Env:RELEASE_ZIPBALL = "zephir_parser_${Env:PHP_ARCH}_vc${Env:VC_VERSION}_php${Env:PHP_VERSION}-nts_${Env:BUILD_VERSION}"

		If ($Env:PHP_ARCH -eq 'x86') {
			$Env:RELEASE_FOLDER = "Release"
		} Else {
			$Env:RELEASE_FOLDER = "x64\Release"
		}
	} Else {
		$Env:RELEASE_ZIPBALL = "zephir_parser_${Env:PHP_ARCH}_vc${Env:VC_VERSION}_php${Env:PHP_VERSION}_${Env:BUILD_VERSION}"

		If ($Env:PHP_ARCH -eq 'x86') {
			$Env:RELEASE_FOLDER = "Release_TS"
		} Else {
			$Env:RELEASE_FOLDER = "x64\Release_TS"
		}
	}

	$Env:RELEASE_PATH = "${Env:APPVEYOR_BUILD_FOLDER}\${Env:RELEASE_FOLDER}"
}
