PicoCTF Capture the flag challenge with a XSS attack

To deploy these challenges, clone this git repository in a folder inside the picoctf/problems folder. Log via SSH to the pico VM.

now, run the following command: sudo shell_manager install login

Afterwards run sudo shell_manager status to see the id of the new installed challenge.

Then run sudo shell_manager deploy id_of_the_new_challenge

After that go to the pioctf management page, to Shell Server and click on Load Deployment

Finally, go to the management section and enable the new challenge. That's it! Now you will be able to find it in the challeges page.

When you do a change you will have to reinstall and redeploy the challenge. To do that run the install and deploy commands again, but add --reinstall to the end of the first command and -r to the end of the second one.

Do the same for the forum challenge.
