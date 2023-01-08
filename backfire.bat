@echo off && setlocal EnableDelayedExpansion

for %%Z in (%*)do set "_arg_=%%Z" && set/a "_cnt+=1+0" && call set "_arg_[!_cnt!]=!_arg_!")

echo "The argument is: !_arg_!"
php ./backfire !_arg_!

goto :eof