@echo off
cd c:\laragon\www\NCCP
git config user.email "jana_sharma@yahoo.com"
git config user.name "janarth20"
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/janarth20/nccp.git
git push -u origin main
