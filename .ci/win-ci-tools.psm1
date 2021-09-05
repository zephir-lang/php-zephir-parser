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
    <#
        .SYNOPSIS
            Configures Environment variables for Release build.
    #>

    # Build artifacts should be names like this:
    # zephir-parser-php-7.0-nts-Win32-VC14-x86.zip
    # zephir-parser-php-7.0-ts-Win32-VC14-x64.zip

    $VC_Prefix = "VC"
    if (${env:VC_VERSION} -ge 16) {
        $VC_Prefix = "VS"
    }

    # Configure for Windows define `BUILD_DIR` using the next logic:
    #
    # Release ZTS x86 => Release_TS\php_zephir_parser.dll
    # Release NTS x86 => Release\php_zephir_parser.dll
    # Release ZTS x64 => x64\Release_TS\php_zephir_parser.dll
    # Release NTS x64 => x64\Release\php_zephir_parser.dll

    $env:RELEASE_FOLDER = "Release"
    if (${env:BUILD_TYPE} -eq 'ts') {
        $env:RELEASE_FOLDER = -join($env:RELEASE_FOLDER, "_TS")
    }

    if (${env:PHP_ARCH} -eq 'x64') {
        $env:RELEASE_FOLDER = -join("x64\", $env:RELEASE_FOLDER)
    }

    $env:RELEASE_DLL_PATH = "${env:GITHUB_WORKSPACE}\${env:RELEASE_FOLDER}\${env:EXTENSION_FILE}"
    $env:RELEASE_ZIPBALL = "zephir-parser-php-${env:PHP_MINOR}-${env:BUILD_TYPE}-Win32-${VC_Prefix}${env:VC_VERSION}-${env:PHP_ARCH}"

    Write-Output "RELEASE_ZIPBALL=${env:RELEASE_ZIPBALL}" | Out-File -FilePath $env:GITHUB_ENV -Encoding utf8 -Append
    Write-Output "RELEASE_DLL_PATH=${env:RELEASE_DLL_PATH}" | Out-File -FilePath $env:GITHUB_ENV -Encoding utf8 -Append
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

function PrepareReleasePackage {
	param (
		[Parameter(Mandatory=$true)]  [System.String] $PhpVersion,
		[Parameter(Mandatory=$true)]  [System.String] $BuildType,
		[Parameter(Mandatory=$true)]  [System.String] $Platform,
		[Parameter(Mandatory=$false)] [System.String] $ZipballName = '',
		[Parameter(Mandatory=$false)] [System.String[]] $ReleaseFiles = @(),
		[Parameter(Mandatory=$false)] [System.String] $ReleaseFile = 'RELEASE.txt',
		[Parameter(Mandatory=$false)] [System.Boolean] $ConverMdToHtml = $false,
		[Parameter(Mandatory=$false)] [System.String] $BasePath = '.'
	)

	$BasePath = Resolve-Path $BasePath
	$ReleaseDirectory = "${Env:GITHUB_ACTOR}-${Env:GITHUB_ACTION}-${Env:GITHUB_JOB}-${Env:GITHUB_RUN_NUMBER}"

	PrepareReleaseNote `
		-PhpVersion       $PhpVersion `
		-BuildType        $BuildType `
		-Platform         $Platform `
		-ReleaseFile      $ReleaseFile `
		-ReleaseDirectory $ReleaseDirectory `
		-BasePath         $BasePath

	$ReleaseDestination = "${BasePath}\${ReleaseDirectory}"

	$CurrentPath = Resolve-Path '.'

	if ($ConverMdToHtml) {
		InstallReleaseDependencies
		FormatReleaseFiles -ReleaseDirectory $ReleaseDirectory
	}

	if ($ReleaseFiles.count -gt 0) {
		foreach ($File in $ReleaseFiles) {
			Copy-Item "${File}" "${ReleaseDestination}"
			Write-Debug "Copy ${File} to ${ReleaseDestination}"
		}
	}

	if (!$ZipballName) {
		if (!$Env:RELEASE_ZIPBALL) {
			throw "Required parameter `"ZipballName`" is missing"
		} else {
			$ZipballName = $Env:RELEASE_ZIPBALL;
		}
	}

	Ensure7ZipIsInstalled

	Set-Location "${ReleaseDestination}"
	$Output = (& 7z a "${ZipballName}.zip" *)
	$ExitCode = $LASTEXITCODE

	$DirectoryContents = Get-ChildItem -Path "${ReleaseDestination}"
	Write-Debug ($DirectoryContents | Out-String)

	if ($ExitCode -ne 0) {
		Set-Location "${CurrentPath}"
		throw "An error occurred while creating release zippbal: `"${ZipballName}`". ${Output}"
	}

	Move-Item "${ZipballName}.zip" -Destination "${BasePath}"
	Set-Location "${CurrentPath}"
}

function InstallPhpDevPack {
    <#
        .SYNOPSIS
            Intstall PHP Developer pack from sources.
    #>

    Write-Output "Install PHP Dev pack: ${env:PHP_VERSION}"

    $TS = Get-ThreadSafety

	if ($env:VC_VERSION -gt 15) {
		$VSPrefix = "VS"
		$VSPrefixSmall = "vs"
	} else {
		$VSPrefix = "VC"
		$VSPrefixSmall = "vc"
	}

    $BaseUrl = "http://windows.php.net/downloads/releases"
    $DevPack = "php-devel-pack-${env:PHP_VERSION}${TS}-Win32-${VSPrefixSmall}${env:VC_VERSION}-${env:PHP_ARCH}.zip"

    $RemoteUrl = "${BaseUrl}/${DevPack}"
    $RemoteArchiveUrl = "${BaseUrl}/archives/${DevPack}"
    $DestinationPath = "C:\Downloads\php-devel-pack-${env:PHP_VERSION}${TS}-${VSPrefix}${env:VC_VERSION}-${env:PHP_ARCH}.zip"

    if (-not (Test-Path $env:PHP_DEVPACK)) {
        if (-not [System.IO.File]::Exists($DestinationPath)) {
            DownloadFileUsingAlternative -RemoteUrl $RemoteUrl `
                -RemoteArchiveUrl $RemoteArchiveUrl `
                -DestinationPath $DestinationPath `
                -Message "Downloading PHP Dev pack"
        }

        $DestinationUnzipPath = "${env:Temp}\php-${env:PHP_VERSION}-devel-${VSPrefix}${env:VC_VERSION}-${env:PHP_ARCH}"

        if (-not (Test-Path "$DestinationUnzipPath")) {
            Expand-Item7zip $DestinationPath $env:Temp
        }

        Move-Item -Path $DestinationUnzipPath -Destination $env:PHP_DEVPACK
    }
}

function DownloadFileUsingAlternative {
    <#
        .SYNOPSIS
            Downloads files from URL using alternative ULR if primary URL not found
    #>

    [CmdletBinding()]
    param(
        [parameter(Mandatory = $true, ValueFromPipeline = $true)] [ValidateNotNullOrEmpty()] [System.String] $RemoteUrl,
        [parameter(Mandatory = $true, ValueFromPipeline = $true)] [ValidateNotNullOrEmpty()] [System.String] $RemoteArchiveUrl,
        [parameter(Mandatory = $true, ValueFromPipeline = $true)] [ValidateNotNullOrEmpty()] [System.String] $DestinationPath,
        [parameter(Mandatory = $true, ValueFromPipeline = $true)] [ValidateNotNullOrEmpty()] [System.String] $Message
    )

    process {
        try {
            Write-Output "${Message}: ${RemoteUrl} ..."
            DownloadFile $RemoteUrl $DestinationPath
        } catch [System.Net.WebException] {
            Write-Output "${Message} from archive: ${RemoteArchiveUrl} ..."
            DownloadFile $RemoteArchiveUrl $DestinationPath
        }
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

function Get-ThreadSafety {
    <#
        .SYNOPSIS
            Detects if Build is Thread Safety or not and returns `ts` suffix.
    #>

    if ($env:BUILD_TYPE -Match "nts") {
        return "-nts"
    }

    return [string]::Empty
}

function AppendSessionPath {
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
