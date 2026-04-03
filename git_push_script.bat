@echo off
cd c:\laragon\www\NCCP
git add .
git commit -m "Initial commit for NCCP dashboard"
git branch -M main
git remote add origin https://github.com/janarth20/nccp.git
git push -u origin main
