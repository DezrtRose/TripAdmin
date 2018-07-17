<?php
/**
 * Description of MailController
 *
 * @author dinesubedi
 */
class MailController extends CI_Controller {
    
    function quickMail() {
        
        if($_POST){
            
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name', 'Name', "required");
            $this->form_validation->set_rules('phone', 'Phone', "required");
            $this->form_validation->set_rules('email', 'Email', "required");
            $this->form_validation->set_rules('country', 'Country', "required");
            $this->form_validation->set_rules('message', 'Message', "required");
            
            if($this->form_validation->run($this)){
            
                $senderName = $this->input->post("name");
                $senderCountry = $this->input->post("country");
                $senderMailId = $this->input->post("email");
                $senderPhone = $this->input->post("phone");
                $senderMessage = $this->input->post("message");
                $msgFooter = "<p>
                                  ".SITE_NAME."<br/>
                                  Address: ".SITE_ADDRESS."<br/>
                                  Phone: ".NUMBER."<br/>
                                  Website: ".SITE."
                              </p>";

                //------------- for admin-------------
                $subject = "Enquiry Received";
                $msgBody =  "<p>Dear Admin,</p>
                                    <p>Someone contacted you. Below are the details</p>
                                    <p>
                                        <strong>Name: </strong>".ucwords(strtolower($senderName))."<br/>
                                        <strong>Email: </strong>".$senderMailId."<br/>
                                        <strong>Country: </strong>".$senderCountry."<br/>    
                                        <strong>Phone: </strong>".$senderPhone."<br/>
                                        <strong>Message: </strong>".$senderMessage."<br/>
                                    </p>
                                    ".$msgFooter."";

                $this->load->library('email');
                $this->email->from($senderMailId, $senderName);
                $this->email->to(SITE_EMAIL);
                $this->email->subject($subject);
                $this->email->set_mailtype("html");
                $this->email->message($msgBody);

                if($this->email->send()){

                    //------------- for client-------------
                    $msgBody1 =  "<div>
                                        <p>Dear ".ucwords(strtolower($senderName)).",</p>
                                        <p>
                                            Thank you for contacting us. We will get back to you as soon as possible.
                                        </p>
                                        <p>Note: This is automated system do not reply to this mail.</p>
                                        ".$msgFooter."
                                    </div>";

                    $this->load->library('email');
                    $this->email->from(SITE_EMAIL, SITE_NAME);
                    $this->email->to($senderMailId);
                    $this->email->subject("Enquiry Received");
                    $this->email->set_mailtype("html");
                    $this->email->message($msgBody1);
                    $this->email->send();

                    set_flash('msg', 'Thank you for contacting. We will get back to you soon.');
                    redirect('thank-you');

                } else {
                    set_flash('msg', 'sorry, something went wrong.');
                    redirect('thank-you');
                }
                
                
            } else {
                
                set_flash('msg', 'sorry, something went wrong.');
                redirect('thank-you');
                
            }
            
        }
        
    }
    
    function contact() {
        
        if ($_POST) {
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name', 'Name', "required");
            $this->form_validation->set_rules('phone', 'Phone', "required");
            $this->form_validation->set_rules('email', 'Email', "required");
            $this->form_validation->set_rules('country', 'Country', "required");
            $this->form_validation->set_rules('message', 'Message', "required");
            
            if($this->form_validation->run($this)){
                
                
                $post = $_POST;
                $custName = $post['name'];
                $custCountry = $post['country'];
                $custPhone = $post['phone'];
                $custEmail = $post['email'];
                $custMsg = $post['message'];
                $msgToAdmin = '<div>
                                <p> Dear Admin, </p>
                                <p> Someone contacted you from the '.SITE.'. Below are the details </p>
                                <p>
                                    <strong>Name: </strong>'.ucwords(strtolower($custName)).'<br/>
                                    <strong>Country: </strong>'.$custCountry.'<br/>
                                    <strong>Email: </strong>'.$custEmail.'<br/>
                                    <strong>Phone: </strong>'.$custPhone.'<br/>
                                    <strong>Message</strong><br/>'.$custMsg.'<br/>
                                </p>
                                <p>
                                    '.SITE_NAME.'<br/>
                                    Address: '.SITE_ADDRESS.'<br/>
                                    Phone: '.NUMBER.'<br/>
                                    Website: '.SITE.'
                                </p>
                            </div>';

                $this->load->library('email');
                $this->email->from($custEmail, $custName);
                $this->email->to(SITE_EMAIL);
                $this->email->subject('Enquiry Received');
                $this->email->set_mailtype("html");
                $this->email->message($msgToAdmin);

                if($this->email->send()){

                        //------------- for client-------------
                        $msgBody1 =  "<div>
                                        <p>Dear ".ucwords(strtolower($custName)).",</p>
                                        <p>
                                            Thank you for contacting us. We will get back to you as soon as possible.
                                        </p>
                                        <p>Note: This is automated system do not reply to this mail.</p>
                                        <p>
                                            ".SITE_NAME."<br/>
                                            Address: ".SITE_ADDRESS."<br/>
                                            Phone: ".NUMBER."<br/>
                                            Website: ".SITE."
                                        </p>
                                    </div>";

                        $this->load->library('email');
                        $this->email->from(SITE_EMAIL, SITE_NAME);
                        $this->email->to($custEmail);
                        $this->email->subject("successfully received mail.");
                        $this->email->set_mailtype("html");
                        $this->email->message($msgBody1);
                        $this->email->send();

                        set_flash('msg', 'Thank you for contacting. We will get back to you soon.');
                        redirect('thank-you');

                } else {
                    set_flash('msg', 'sorry, something went wrong.');
                    redirect('thank-you');
                }   
            } else {
                
                $val_error = validation_errors();
                $this->session->set_flashdata('val_error', $val_error);
                redirect(base_url('contact-us'));
            }
        }
        
    }
    
    function tripBook() {
        
        if($_POST){
            
            $emailId = $this->input->post("email");
            $firstName = $this->input->post("first_name");
            $lastName = $this->input->post("last_name");
            $margin = "margin-bottom: 0";
            $fullName = "".$firstName." ".$lastName."";
            $subject = "Enquiry Received";
            $footerBdy = "<h3 style=".$margin."> With Regards </h3>
                            ".SITE_NAME."<br/>
                            Address: ".SITE_ADDRESS."<br/>
                            Phone: ".NUMBER."<br/>
                            Website: ".SITE."";


            if($this->input->post("departure_id")!=NULL){

                $departurId = $this->input->post("departure_id");
                $departure = $this->common_model->getWhere('tbl_departure_date', ['id' => $departurId]);
                $departure = $departure[0];

                $dprtrBdy = "<h3 style=".$margin."><u>Departure Date Details</u></h3>
                            <strong>Start Date:</strong> ".date('F dS, Y', strtotime($departure['date_from']))."<br/>
                            <strong>End Date:</strong> ".date('F dS, Y', strtotime($departure['date_to']))."<br/>
                            <strong>Price:</strong> $".$departure['price']."<br/>
                            <strong>Status:</strong> ".$departure['type']."<br/>";
                $dateBdy = "";
            } else {
                $dprtrBdy = "<h3 style=".$margin."><u>No departure for this trip.</u></h3>";
                $dateBdy = "<strong>Start Date: </strong>".$this->input->post("date")."<br/>";
            }

            $massageBody = "<div>
                                <p> Dear Admin, </p>
                                <p> A new booking has been made from ".SITE.".<br> Below are the details. </p>
                                <div>
                                    <p> <h3 style = ".$margin."> <u>Trip Details</u> </h3>
                                        <strong>Trip Name: </strong>".$this->input->post("trip")."<br/>
                                        <strong>Nationality: </strong>".($this->input->post("country"))."<br/>
                                        ".$dateBdy."
                                        <strong>Number of Travellers: </strong>".($this->input->post("pax"))."<br/>
                                    </p>
                                </div>
                                <div>
                                    <p>
                                        <h3 style=".$margin."> <u>Traveller Information</u> </h3>
                                        <strong>Name: </strong>".$fullName."<br/>
                                        <strong>Country: </strong>".($this->input->post("country"))."<br/>
                                        <strong>Email: </strong>".$emailId."<br/>
                                        <strong>Phone Number: </strong>".($this->input->post("phone"))."<br/>
                                        <strong>Age: </strong>".($this->input->post("age"))."<br/>
                                        <strong>Gender: </strong>".($this->input->post("gender"))."<br/>
                                        <strong>Mailing Address: </strong>".($this->input->post("mailing_address"))."<br/>
                                        <strong>Passport Number: </strong>".($this->input->post("passport"))."<br/>
                                        <strong>Place of Issue: </strong>".($this->input->post("issue"))."<br/>
                                        <strong>Issue Date: </strong>".($this->input->post("issue_date"))."<br/>
                                        <strong>Expiration Date: </strong>".($this->input->post("exp_date"))."<br/>
                                        <strong>Emergency Contact: </strong>".($this->input->post("emergency"))."<br/>
                                        <strong>Insurance: </strong>".($this->input->post("insurance"))."<br>
                                        <strong>Special Requiest: </strong>".($this->input->post("special_request"))."
                                    </p>
                                </div>                    
                                <div>".$dprtrBdy."</div>
                                <p>".$footerBdy."</p>    
                            </div>";

            $this->load->library('email');
            $this->email->from($emailId, $fullName);
            $this->email->to(SITE_EMAIL);
            $this->email->subject($subject);
            $this->email->set_mailtype("html");
            $this->email->message($massageBody);
            if($this->email->send()){

                $msgBdyCust ="<div>
                                <p>Dear ".$fullName.",</p>
                                <p>
                                    Thank you for your interest in ".$this->input->post("trip").". We have received your information and will be in
                                    contact with you very shortly.
                                </p>
                                <p>this is automated system do not reply to this mail.</p>
                                <p>".$footerBdy."</p>
                            </div>";

                $this->load->library('email');
                $this->email->from(SITE_EMAIL, SITE_NAME);
                $this->email->to($emailId);
                $this->email->subject($subject);
                $this->email->set_mailtype("html");
                $this->email->message($msgBdyCust);
                $this->email->send();

                set_flash('msg', 'Thank you for contacting. We will get back to you soon.');
                redirect('thank-you');
            } else {

                set_flash('msg', 'Sorry, something went wrong please try again latter.');
                redirect('thank-you');
            }
        }   
    }
}
