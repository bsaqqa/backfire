@echo off && setlocal EnableDelayedExpansion

set _args_=%*

php "%~dp0backfire" !_args_!

goto :eof