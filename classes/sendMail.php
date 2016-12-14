<?php

//note: fcomeau: check the path
        require_once __DIR__.'/../vendor/autoload.php';
     
        //use PHPMailer;
        
        class sendMail{
            //add some properties to hold mailing attributes
            //protected can be accessed only within the class itself and by inherited classes.
            protected $toname;
            protected $toemail;
            protected $fromname;
            protected $fromemail;
            protected $messagetext;
            protected $messagehtml;
            protected $mailsubject;
            protected $replytoname;
            protected $replytoemail;
            
            //constructor
            /**
             * sendmail() class
             * this class will send email using gmail
             * @param string $replyToEmail
             * @param string $replyToName
             * @param string $mailSubject
             * @param string $messageHTML
             * @param string $messageTEXT
             * @param string $fromEmail
             * @param string $fromName
             * @param string $toEmail
             * @param string $toName
             */
            public function __construct(string $replyToEmail, string $replyToName, string $mailSubject, string $messageHTML,
                                        string $messageTEXT, string $fromEmail, string $fromName, 
                                        string $toEmail, string $toName) {
               $this->replytoemail=$replyToEmail;
               $this->replytoname=$replyToName;
               $this->mailsubject=$mailSubject;
               $this->messagehtml=$messageHTML;
               $this->messagetext=$messageTEXT;
               $this->fromemail=$fromEmail;
               $this->fromname=$fromName;
               $this->toemail=$toEmail;
               $this->toname=$toName;
            }//end of constructor
            
            public function SendMail():bool{
               
                //instantiate the phpMailer
                $mail = new PHPMailer();
                
                //setup PHPMailer properties
                $mail->isSMTP();
                $mail->SMTPDebug=0;
                $mail->Host='smtp.gmail.com';
                $mail->Port=465;
                $mail->SMTPAuth=true;
                $mail->Username='fabiencomeau5@gmail.com';
                $mail->Password='Bigbang01';
                $mail->SMTPSecure='ssl';
                
                $mail->From=$this->fromemail;
                $mail->FromName=$this->fromname;
                $mail->addAddress($this->toemail, $this->toname);
                
                if(!empty($this->replytoemail)){
                    $mail->addReplyTo($this->replytoemail, $this->replytoname);
                }
                $mail->isHTML(true);
                $mail->Subject=$this->mailsubject;
                $mail->Body=$this->messagehtml;
                $mail->AltBody=$this->messagetext;
                
                //send mail
                if($mail->send()){
                    return true;
                }else{
                    return false;
                }
                
            }
        }//end of class