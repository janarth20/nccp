@echo off
cd c:\laragon\www\NCCP
git commit -m "Initial commit" > git_error.txt 2>&1
git branch -a >> git_error.txt 2>&1
