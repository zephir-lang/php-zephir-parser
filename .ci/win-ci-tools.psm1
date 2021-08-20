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

function InitializeReleaseVars {
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

function InstallPhpSdk {
    <#
        .SYNOPSIS
            Install PHP SDK binary tools from sources.
    #>

    Write-Output "Install PHP SDK binary tools: ${env:PHP_SDK_VERSION}"

    $PhpSdk = "php-sdk-${env:PHP_SDK_VERSION}.zip"
    $RemoteUrl = "https://github.com/microsoft/php-sdk-binary-tools/archive/${PhpSdk}"
    $DestinationPath = "C:\Downloads\${PhpSdk}"

    if (-not (Test-Path $env:PHP_SDK_PATH)) {
        if (-not [System.IO.File]::Exists($DestinationPath)) {
            Write-Output "Downloading PHP SDK binary tools: $RemoteUrl ..."
            DownloadFile $RemoteUrl $DestinationPath
        }

        $DestinationUnzipPath = "${env:Temp}\php-sdk-binary-tools-php-sdk-${env:PHP_SDK_VERSION}"

        if (-not (Test-Path "$DestinationUnzipPath")) {
            Expand-Item7zip $DestinationPath $env:Temp
        }

        Move-Item -Path $DestinationUnzipPath -Destination $env:PHP_SDK_PATH
    }
}

function DownloadFile {
    <#
        .SYNOPSIS
            Downloads file from providing URL to specified destionation.

        .NOTES
            Throws System.Net.WebException if $RequestUrl not found.
    #>

    [CmdletBinding()]
    param(
        [parameter(Mandatory = $true)] [ValidateNotNullOrEmpty()] [System.String] $RemoteUrl,
        [parameter(Mandatory = $true)] [ValidateNotNullOrEmpty()] [System.String] $DestinationPath
    )

    process {
        $RetryMax   = 5
        $RetryCount = 0
        $Completed  = $false

        $WebClient = New-Object System.Net.WebClient
        $WebClient.Headers.Add('User-Agent', 'GitHub Actions PowerShell Script')

        while (-not $Completed -or $RetryCount -eq $RetryMax) {
            try {
                $WebClient.DownloadFile($RemoteUrl, $DestinationPath)
                $Completed = $true
            } catch [System.Net.WebException] {
                $ErrorMessage = $_.Exception.Message

                if ($_.Exception.Response.StatusCode -eq 404) {
                    Write-Warning -Message "Error downloading ${RemoteUrl}: $ErrorMessage"
                    throw [System.Net.WebException] "Error downloading ${RemoteUrl}"
                }

                if ($RetryCount -ge $RetryMax) {
                    Write-Output "Error downloading ${RemoteUrl}: $ErrorMessage"
                    $Completed = $true
                } else {
                    $RetryCount++
                }
            }
        }
    }
}

function Expand-Item7zip {
    <#
        .SYNOPSIS
            Extracts ZIP archives to specified directory
    #>

    param(
        [Parameter(Mandatory = $true)] [System.String] $Archive,
        [Parameter(Mandatory = $true)] [System.String] $Destination
    )

    if (-not (Test-Path -Path $Archive -PathType Leaf)) {
        throw "Specified archive File is invalid: [$Archive]"
    }

    if (-not (Test-Path -Path $Destination -PathType Container)) {
        New-Item $Destination -ItemType Directory | Out-Null
    }

    $Result = (& 7z x "$Archive" "-o$Destination" -aoa -bd -y -r)

    if ($LastExitCode -ne 0) {
        Write-Output "An error occurred while unzipping [$Archive] to [$Destination]. Error code was: ${LastExitCode}"
        Exit $LastExitCode
    }
}
