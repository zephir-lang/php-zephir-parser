Function EnsureRequiredDirectoriesPresent {
	If (-not (Test-Path 'C:\Downloads')) {
		New-Item -ItemType Directory -Force -Path 'C:\Downloads' | Out-Null
	}

	If (-not (Test-Path 'C:\Projects')) {
		New-Item -ItemType Directory -Force -Path 'C:\Projects' | Out-Null
	}
}

Function Ensure7ZipIsInstalled {
    If (-not (Get-Command "7z" -ErrorAction SilentlyContinue)) {
        $7zipInstallationDirectory = "${Env:ProgramFiles}\7-Zip"

        If (-not (Test-Path "$7zipInstallationDirectory")) {
            throw "The 7-zip file archiver is needed to use this module"
        }

		$Env:Path += ";$7zipInstallationDirectory"
    }
}

Function EnsureChocolateyIsInstalled {
    If (-not (Get-Command "choco" -ErrorAction SilentlyContinue)) {
        $ChocolateyInstallationDirectory = "${Env:ProgramData}\chocolatey\bin"

        If (-not (Test-Path "$ChocolateyInstallationDirectory")) {
            throw "The choco is needed to use this module"
        }

		$Env:Path += ";$ChocolateyInstallationDirectory"
    }
}

Function EnsurePandocIsInstalled {
    If (-not (Get-Command "pandoc" -ErrorAction SilentlyContinue)) {
        $PandocInstallationDirectory = "${Env:ProgramData}\chocolatey\bin"

        If (-not (Test-Path "$PandocInstallationDirectory")) {
            throw "The pandoc is needed to use this module"
        }

		$Env:Path += ";$PandocInstallationDirectory"
	}

	& "pandoc" -v
}

Function InstallSdk {
	Write-Host "Install PHP SDK binary tools: ${Env:PHP_SDK_VERSION}" -foregroundcolor Cyan

	$RemoteUrl = "https://github.com/OSTC/php-sdk-binary-tools/archive/php-sdk-${Env:PHP_SDK_VERSION}.zip"
	$DestinationPath = "C:\Downloads\php-sdk-${Env:PHP_SDK_VERSION}.zip"

	If (-not (Test-Path $Env:PHP_SDK_PATH)) {
		If (-not [System.IO.File]::Exists($DestinationPath)) {
			Write-Host "Downloading PHP SDK binary tools: $RemoteUrl ..."
			DownloadFile $RemoteUrl $DestinationPath
		}

		$DestinationUnzipPath = "${Env:Temp}\php-sdk-binary-tools-php-sdk-${Env:PHP_SDK_VERSION}"

		If (-not (Test-Path "$DestinationUnzipPath")) {
			Expand-Item7zip $DestinationPath $Env:Temp
		}

		Move-Item -Path $DestinationUnzipPath -Destination $Env:PHP_SDK_PATH
	}
}

Function InstallPhp {
	Write-Host "Install PHP: ${Env:PHP_VERSION}" -foregroundcolor Cyan

	$RemoteUrl = "http://windows.php.net/downloads/releases/php-${Env:PHP_VERSION}-${Env:BUILD_TYPE}-vc${Env:VC_VERSION}-${Env:PLATFORM}.zip"
	$DestinationPath = "C:\Downloads\php-${Env:PHP_VERSION}-${Env:BUILD_TYPE}-VC${Env:VC_VERSION}-${Env:PLATFORM}.zip"

	If (-not (Test-Path $Env:PHP_PATH)) {
		If (-not [System.IO.File]::Exists($DestinationPath)) {
			Write-Host "Downloading PHP source code: $RemoteUrl ..."
			DownloadFile $RemoteUrl $DestinationPath
		}

		Expand-Item7zip "$DestinationPath" "${Env:PHP_PATH}"
	}

	If (-not (Test-Path "${Env:PHP_PATH}\php.ini")) {
		Copy-Item "${Env:PHP_PATH}\php.ini-development" "${Env:PHP_PATH}\php.ini"
	}
}

Function InstallPhpDevPack {
	Write-Host "Install PHP Dev pack: ${Env:PHP_VERSION}" -foregroundcolor Cyan

	$RemoteUrl = "http://windows.php.net/downloads/releases/php-devel-pack-${Env:PHP_VERSION}-${Env:BUILD_TYPE}-vc${Env:VC_VERSION}-${Env:PLATFORM}.zip"
	$DestinationPath = "C:\Downloads\php-devel-pack-${Env:PHP_VERSION}-${Env:BUILD_TYPE}-VC${Env:VC_VERSION}-${Env:PLATFORM}.zip"

	If (-not (Test-Path $Env:DEVPACK_PATH)) {
		If (-not [System.IO.File]::Exists($DestinationPath)) {
			Write-Host "Downloading PHP Dev pack: $RemoteUrl ..."
			DownloadFile $RemoteUrl $DestinationPath
		}

		$DestinationUnzipPath = "${Env:Temp}\php-${Env:PHP_VERSION}-devel-VC${Env:VC_VERSION}-${Env:PLATFORM}"

		If (-not (Test-Path "$DestinationUnzipPath")) {
			Expand-Item7zip $DestinationPath $Env:Temp
		}

		Move-Item -Path $DestinationUnzipPath -Destination $Env:DEVPACK_PATH
	}
}

Function InstallBuildDependencies {
	EnsureChocolateyIsInstalled

	choco install -y --no-progress pandoc

	If (-not (Test-Path "${Env:APPVEYOR_BUILD_FOLDER}\package")) {
		New-Item -ItemType Directory -Force -Path "${Env:APPVEYOR_BUILD_FOLDER}\package" | Out-Null
	}
}

Function InitializeBuildVars {
	switch ($Env:VC_VERSION) {
		'14' {
			If (-not (Test-Path $Env:VS120COMNTOOLS)) {
				throw 'The VS120COMNTOOLS environment variable is not set. Check your MS VS installation'
			}
			$Env:VSCOMNTOOLS = $Env:VS120COMNTOOLS
			break
		}
		'15' {
			If (-not (Test-Path $Env:VS140COMNTOOLS)) {
				throw 'The VS140COMNTOOLS environment variable is not set. Check your MS VS installation'
			}
			$Env:VSCOMNTOOLS = $Env:VS140COMNTOOLS
			break
		}
		default {
			throw 'This script is designed to run with MS VS 14/15. Check your MS VS installation'
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
		$Env:RELEASE_ZIPBALL = "${Env:PACKAGE_PREFIX}_${Env:PLATFORM}_vc${Env:VC_VERSION}_php${Env:PHP_MINOR}-nts_${Env:APPVEYOR_BUILD_VERSION}"

		If ($Env:PLATFORM -eq 'x86') {
			$Env:RELEASE_FOLDER = "Release"
		} Else {
			$Env:RELEASE_FOLDER = "x64\Release"
		}
	} Else {
		$Env:RELEASE_ZIPBALL = "${Env:PACKAGE_PREFIX}_${Env:PLATFORM}_vc${Env:VC_VERSION}_php${Env:PHP_MINOR}_${Env:APPVEYOR_BUILD_VERSION}"

		If ($Env:PLATFORM -eq 'x86') {
			$Env:RELEASE_FOLDER = "Release_TS"
		} Else {
			$Env:RELEASE_FOLDER = "x64\Release_TS"
		}
	}

	$Env:RELEASE_PATH = "${Env:APPVEYOR_BUILD_FOLDER}\${Env:RELEASE_FOLDER}"
}

Function PrepareReleaseNote {
	$ReleaseFile = "${Env:APPVEYOR_BUILD_FOLDER}\package\RELEASE.txt"
	$ReleaseDate = Get-Date -Format g

	Write-Output "Release date: ${ReleaseDate}"                           | Out-File -Encoding "ASCII" -Append "${ReleaseFile}"
	Write-Output "Release version: ${Env:APPVEYOR_BUILD_VERSION}"         | Out-File -Encoding "ASCII" -Append "${ReleaseFile}"
	Write-Output "Git commit: ${Env:APPVEYOR_REPO_COMMIT}"                | Out-File -Encoding "ASCII" -Append "${ReleaseFile}"
	Write-Output "Build type: ${Env:BUILD_TYPE}"                          | Out-File -Encoding "ASCII" -Append "${ReleaseFile}"
	Write-Output "Platform: ${Env:PLATFORM}"                              | Out-File -Encoding "ASCII" -Append "${ReleaseFile}"
	Write-Output "Target PHP version: ${Env:PHP_MINOR}"                   | Out-File -Encoding "ASCII" -Append "${ReleaseFile}"
	Write-Output "Build worker image: ${Env:APPVEYOR_BUILD_WORKER_IMAGE}" | Out-File -Encoding "ASCII" -Append "${ReleaseFile}"
}

Function PrepareReleasePackage {
	PrepareReleaseNote

	$CurrentPath = (Get-Item -Path ".\" -Verbose).FullName
	$PackagePath = "${Env:APPVEYOR_BUILD_FOLDER}\package"

	FormatReleaseFiles

	Copy-Item "${Env:RELEASE_PATH}\${Env:EXTENSION_FILE}"              "${PackagePath}"
	Copy-Item "${Env:APPVEYOR_BUILD_FOLDER}\LICENSE"                   "${PackagePath}"
	Copy-Item "${Env:APPVEYOR_BUILD_FOLDER}\CREDITS"                   "${PackagePath}"
	Copy-Item "${Env:APPVEYOR_BUILD_FOLDER}\VERSION"                   "${PackagePath}"
	Copy-Item "${Env:APPVEYOR_BUILD_FOLDER}\README.WIN32-BUILD-SYSTEM" "${PackagePath}"
	Copy-Item "${Env:APPVEYOR_BUILD_FOLDER}\NO_WARRANTY"               "${PackagePath}"

	Set-Location "${PackagePath}"
	$result = (& 7z a "${Env:RELEASE_ZIPBALL}.zip" *.*)

	$7zipExitCode = $LASTEXITCODE
	If ($7zipExitCode -ne 0) {
		Set-Location "${CurrentPath}"
		throw "An error occurred while creating release zippbal to [${Env:RELEASE_ZIPBALL}.zip]. 7Zip Exit Code was [${7zipExitCode}]"
	}

	Move-Item "${Env:RELEASE_ZIPBALL}.zip" -Destination "${Env:APPVEYOR_BUILD_FOLDER}"

	Set-Location "${CurrentPath}"
}

Function FormatReleaseFiles {
	EnsurePandocIsInstalled

	$CurrentPath = (Get-Item -Path ".\" -Verbose).FullName

	Set-Location "${Env:APPVEYOR_BUILD_FOLDER}"

	Get-ChildItem (Get-Item -Path ".\" -Verbose).FullName *.md |
	ForEach-Object{
		$BaseName = $_.BaseName
		pandoc -f markdown -t html5 "${BaseName}.md" > "package/${BaseName}.html"
	}

	Set-Location "${CurrentPath}"
}

Function SetupPhpVersionString {
	$RemoteUrl = 'http://windows.php.net/downloads/releases/sha1sum.txt';
	$DestinationPath = "${Env:Temp}\php-sha1sum.txt"

	If (-not [System.IO.File]::Exists($DestinationPath)) {
		Write-Host "Downloading PHP SHA Sums: $RemoteUrl..."
		DownloadFile $RemoteUrl $DestinationPath
	}

	$versions = Get-Content $DestinationPath | Where-Object { $_ -match "php-($Env:PHP_MINOR\.\d+)-src" } | ForEach-Object { $matches[1] }

	$Env:PHP_VERSION = $versions.Split(' ')[-1]
}

Function TuneUpPhp {
	$IniFile = "${Env:PHP_PATH}\php.ini"
	$ExtPath = "${Env:PHP_PATH}\ext"

	Write-Host "Tune up PHP: $IniFile" -foregroundcolor Cyan

	If (-not [System.IO.File]::Exists($IniFile)) {
		throw "Unable to locate $IniFile file"
	}

	Write-Output ""                               | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output "extension_dir = ${ExtPath}"     | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output "memory_limit = 256M"            | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output ""                               | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output "extension = php_curl.dll"       | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output "extension = php_openssl.dll"    | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output "extension = php_mbstring.dll"   | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output "extension = php_pdo_sqlite.dll" | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output "extension = php_fileinfo.dll"   | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output "extension = php_gettext.dll"    | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output "extension = php_gd2.dll"        | Out-File -Encoding "ASCII" -Append $IniFile
}

Function EnableExtension {
	$ExtPath = "${Env:RELEASE_PATH}\${Env:EXTENSION_FILE}"
	$IniFile = "${Env:PHP_PATH}\php.ini"
	$PhpExe  = "${Env:PHP_PATH}\php.exe"

	If (-not [System.IO.File]::Exists($IniFile)) {
		throw "Unable to locate ${IniFile}"
	}

	If (-not (Test-Path "${ExtPath}")) {
		throw "Unable to locate extension path: ${ExtPath}"
	}

	Write-Output "[${Env:EXTENSION_NAME}]" | Out-File -Encoding "ASCII" -Append $IniFile
	Write-Output "extension = ${ExtPath}"  | Out-File -Encoding "ASCII" -Append $IniFile

	If (Test-Path -Path "${PhpExe}") {
		& "${PhpExe}" --ri "${Env:EXTENSION_NAME}"

		$PhpExitCode = $LASTEXITCODE
		If ($PhpExitCode -ne 0) {
			PrintPhpInfo
			throw "An error occurred while enabling [${Env:EXTENSION_NAME}] in [$IniFile]. PHP Exit Code was [$PhpExitCode]."
		}
	}
}

Function PrintLogs {
	Set-Location -Path "${Env:APPVEYOR_BUILD_FOLDER}"

	If (Test-Path -Path "${Env:APPVEYOR_BUILD_FOLDER}\compile-errors.log") {
		Get-Content -Path "${Env:APPVEYOR_BUILD_FOLDER}\compile-errors.log"
	}

	If (Test-Path -Path "${Env:APPVEYOR_BUILD_FOLDER}\compile.log") {
		Get-Content -Path "${Env:APPVEYOR_BUILD_FOLDER}\compile.log"
	}

	If (Test-Path -Path "${Env:APPVEYOR_BUILD_FOLDER}\configure.js") {
		Get-Content -Path "${Env:APPVEYOR_BUILD_FOLDER}\configure.js"
	}
}

Function PrintVars {
	Write-Host ($Env:Path).Replace(';', "`n")

	Get-ChildItem Env:
}

Function PrintDirectoriesContent {
	If (Test-Path -Path "${Env:APPVEYOR_BUILD_FOLDER}") {
		Get-ChildItem -Path "${Env:APPVEYOR_BUILD_FOLDER}"
	}

	If (Test-Path -Path "C:\Downloads") {
		Get-ChildItem -Path "C:\Downloads"
	}

	If (Test-Path -Path "C:\Projects") {
		Get-ChildItem -Path "C:\Projects"
	}
}

Function PrintPhpInfo {
	$IniFile = "${Env:PHP_PATH}\php.ini"

	If (Test-Path -Path "${IniFile}") {
		Get-Content -Path "${IniFile}"
	}

	$PhpExe = "${Env:PHP_PATH}\php.exe"

	If (Test-Path -Path "${IniFile}") {
		& "${PhpExe}" -v
		& "${PhpExe}" -m
	}
}

Function Expand-Item7zip {
    param(
        [Parameter(Mandatory=$true)]
        [string] $Archive,
        [Parameter(Mandatory=$true)]
        [string] $Destination
        )

        If (-not (Test-Path -Path $Archive -PathType Leaf)) {
            throw "Specified archive File is invalid: [$Archive]"
        }

        If (-not (Test-Path -Path $Destination -PathType Container)) {
            New-Item $Destination -ItemType Directory | Out-Null
        }

        $result = (& 7z x "$Archive" "-o$Destination" -aoa -bd -y -r)

        $7zipExitCode = $LASTEXITCODE
        If ($7zipExitCode -ne 0) {
            throw "An error occurred while unzipping [$Archive] to [$Destination]. 7Zip Exit Code was [$7zipExitCode]"
        }
}

Function DownloadFile {
    param(
        [Parameter(Mandatory=$true)]
        [string] $RemoteUrl,
        [Parameter(Mandatory=$true)]
        [string] $DestinationPath
		)

		$Retrycount = 5
		$Retrycount = 0
		$Completed  = $false

		$WebClient = new-object System.Net.WebClient

		While (-not $Completed) {
			Try {
				$WebClient.DownloadFile($RemoteUrl, $DestinationPath)
				$Completed = $true
			} Catch {
				If ($Retrycount -ge $Retrycount) {
					$ErrorMessage = $_.Exception.Message
					Write-Host "Error downloadingig ${RemoteUrl}: $ErrorMessage"
					$Completed = $true
				} Else {
					$Retrycount++
				}
			}
		}
}

Function AppendSessionPath {
	$PathsCollection  = @("C:\Program Files (x86)\MSBuild\${Env:VC_VERSION}.0\Bin")
	$PathsCollection += "C:\Program Files (x86)\Microsoft Visual Studio ${Env:VC_VERSION}.0\VC"
	$PathsCollection += "C:\Program Files (x86)\Microsoft Visual Studio ${Env:VC_VERSION}.0\VC\bin"
	$PathsCollection += "${Env:PHP_SDK_PATH}\bin"
	$PathsCollection += "${Env:PHP_PATH}\bin"
	$PathsCollection += "${Env:PHP_PATH}"

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
