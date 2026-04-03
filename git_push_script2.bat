@echo off
cd c:\laragon\www\NCCP
git config user.jana_sharma@yahoo.com "[EMAIL_ADDRESS]"
git config user.janarth20 "janarth20.jana_sharma"
git add .
git commit -m "Initial commit for NCCP dashboard"
git branch -M main
git push -u origin main
