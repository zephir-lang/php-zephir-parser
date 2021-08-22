FROM mcr.microsoft.com/windows/servercore:ltsc2019

COPY . C:/php-zephir-parser

# Download required functions for git installation
RUN powershell.exe -Command \
  	((new-object net.webclient).DownloadFile('https://raw.githubusercontent.com/actions/virtual-environments/5690645f0e91c30d888353d7b58432dc0466eca9/images/win/scripts/ImageHelpers/ChocoHelpers.ps1', 'C:\ChocoHelpers.ps1')); \
	((new-object net.webclient).DownloadFile('https://raw.githubusercontent.com/actions/virtual-environments/f93413492e47983bafbc29ab84cb697aeeb41f7b/images/win/scripts/ImageHelpers/InstallHelpers.ps1', 'C:\InstallHelpers.ps1')); \
    ((new-object net.webclient).DownloadFile('https://raw.githubusercontent.com/actions/virtual-environments/b7f276c003aea42575b52247bdb2183e355fca2f/images/win/scripts/ImageHelpers/PathHelpers.ps1', 'C:\PathHelpers.ps1'));

# Install Choco and Git
RUN powershell.exe -Command \
    Import-Module C:\ChocoHelpers.ps1; \
    Import-Module C:\InstallHelpers.ps1; \
    Import-Module C:\PathHelpers.ps1; \
    Invoke-Expression ((new-object net.webclient).DownloadString('https://raw.githubusercontent.com/actions/virtual-environments/main/images/win/scripts/Installers/Install-Choco.ps1')); \
    Invoke-Expression ((new-object net.webclient).DownloadString('https://raw.githubusercontent.com/actions/virtual-environments/main/images/win/scripts/Installers/Install-Git.ps1'));

# Clone 'virtual-environments'
RUN powershell.exe git clone https://github.com/actions/virtual-environments.git

# Install all necessary dependecies
RUN powershell.exe -Command \
    Import-Module C:\virtual-environments\images\win\scripts\ImageHelpers\PathHelpers.ps1; \
    Import-Module C:\virtual-environments\images\win\scripts\ImageHelpers\InstallHelpers.ps1; \
    Import-Module C:\virtual-environments\images\win\scripts\ImageHelpers\ChocoHelpers.ps1; \
    Import-Module C:\virtual-environments\images\win\scripts\ImageHelpers\VisualStudioHelpers.ps1; \
    Invoke-Expression C:\virtual-environments\images\win\scripts\Installers\Install-VCRedist.ps1; \
    Invoke-Expression C:\virtual-environments\images\win\scripts\Installers\Install-VS.ps1; \
    Invoke-Expression C:\virtual-environments\images\win\scripts\Installers\Install-PHP.ps1;

RUN curl -SL --output vs_buildtools.exe https://aka.ms/vs/16/release/vs_buildtools.exe && \
    (start /w vs_buildtools.exe --quiet --wait --norestart --nocache modify \
        --installPath "C:\BuildTools" \
        --add Microsoft.VisualStudio.Workload.AzureBuildTools \
        --remove Microsoft.VisualStudio.Component.Windows10SDK.10240 \
        --remove Microsoft.VisualStudio.Component.Windows10SDK.10586 \
        --remove Microsoft.VisualStudio.Component.Windows10SDK.14393 \
        --remove Microsoft.VisualStudio.Component.Windows81SDK) && \
    del /q vs_buildtools.exe

RUN dir "C:\BuildTools"

#RUN call "C:\\Program Files (x86)\\Microsoft Visual Studio\\2019\\BuildTools\\Common7\\Tools\\VsDevCmd.bat"

ENV PHP_VERSION=8.0.9
ENV PHP_MINOR=8.0
ENV TEST_PHP_EXECUTABLE=C:/php/php.exe
ENV BUILD_TYPE=ts
ENV VC_VERSION=16
ENV PHP_ARCH=x64
ENV BUILD_VERSION=1

ENV PHP_SDK_VERSION=2.2.0
ENV PHP_DEVPACK=C:/tools/php-devpack
ENV PHP_SDK_PATH=C:/tools/php-sdk
ENV EXTENSION_FILE=php_zephir_parser.dll

# choco install visualstudio2019-workload-vctools; \
# choco install llvm; \
RUN powershell.exe -Command \
    choco install 7zip; \
    Import-Module C:\php-zephir-parser\.ci\win-ci-tools.psm1; \
    SetupCommonEnvironment; \
    InstallPhpSdk; \
    InstallPhpDevPack; \
    AppendSessionPath;

RUN call C:\tools\php-sdk\bin\phpsdk_setvars.bat && \
    cd C:\php-zephir-parser\parser && \
    cl.exe lemon.c && \
	DEL zephir.c zephir.h parser.c scanner.c && \
	re2c.exe -o scanner.c scanner.re && \
	lemon.exe -s zephir.lemon && \
	ECHO #include ^<php.h^> > parser.c && \
	TYPE zephir.c >> parser.c && \
	TYPE base.c >> parser.c
