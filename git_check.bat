@echo off
cd c:\laragon\www\NCCP
git status > git_output.txt 2>&1
git log -1 >> git_output.txt 2>&1
git branch -a >> git_output.txt 2>&1
