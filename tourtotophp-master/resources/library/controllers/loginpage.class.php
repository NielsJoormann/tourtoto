<?php

require_once('basepage.class.php');

class loginPage extends basePage
{   
    protected function showContent()
    {
        echo "<div class= 'container'>
                <div class=loginbg>
                    <div class='logintabel'>
                        <form action='index.php?page=home' method = 'POST'>
                            <input type= 'hidden' name='page' value='login'
                            <table>
                                <tr>
                                <td>
                                    <label>Username</label>
                                    <input type = 'text' name='username' placeholder='username' focus=focus/>
                                </td>
                                </tr>
                                <tr>
                                <td>
                                    <label>Password</label>
                                    <input type ='password' name='password' placeholder='password' />
                                </td>
                                </tr>
                            </table>                    
                            <input type='submit' value='Login'/> 
                        </form>
                    </div>        
                </div>
            </div>
            ";
    } 
    
    protected function showMenuItems()
    {
        
    }
    
    protected function showSubmenuItems() 
    {
       
    }
//===============================================================================================================        
    
}### End of class