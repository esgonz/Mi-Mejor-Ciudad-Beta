<?php 
$plantilla_email='
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> MiMejorCiudad.cl</title>
    </head>
    <body marginwidth="0" topmargin="0" marginheight="0" offset="0">
        <div id="wrapper" style="max-width: 100%;">
            <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
                <tbody><tr>
                    <td align="center" valign="top">
                        <div id="template_header_image" style="background: #6ABFB3;padding-bottom: 1em; padding-top: 1em; "> <p style="margin-top:0;"><img src="http://cupontu.com/tesis/proyecto-titulo/public_html/css/img/logo_mejorciudad.png"></p>
                            
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container" style="color: #666!important; "> <tbody><tr>
                                <td align="center" valign="top">
                                    <!-- Header -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_header">
                                        <tbody><tr>
                                            <td id="header_wrapper">
                                                <h1>'.$mensaje["titulo"].'</h1>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    <!-- End Header -->
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top">
                                    <!-- Body -->
                                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
                                        <tbody><tr>
                                            <td valign="top" id="body_content">
                                                <!-- Content -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tbody><tr>
                                                        <td valign="top">
                                                            <div id="body_content_inner">


                                                                '.$mensaje["contenido"].'




                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                                <!-- End Content -->
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    <!-- End Body -->
                                </td>
                            </tr>
                            <tr style="background: #7B7B7B; color: white; "> <td align="center" valign="top">
                                    <!-- Footer -->
                                    <table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer">
                                        <tbody><tr>
                                            <td valign="top">
                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                                    <tbody><tr>
                                                        <td colspan="2" valign="middle" id="credit">
                                                            
                                                        <p>Este correo fue enviado por mimejorciudad.cl a estebangon.g@gmail.com. Puedes editar tus preferencias ingresando con tu usuario en la aplicacion web</p><p>
                                                        </p><h4>mimejorciudad.cl</h4>
                                                        <ul style=""> 
                                                            <li style="color: gray; "><a href="#" style="color: #00D6F9; ">Registrarse</a></li> 
                                                            <li style="color: gray; "><a href="#" style="color: #00D6F9; ">Iniciar Sesion</a></li>
                                                            <li style="color: gray; "><a href="#" style="color: #00D6F9; ">Ver Causas</a></li>
                                                            <li style="color: gray; "><a href="#" style="color: #00D6F9; ">Crear una nueva Causa</a></li>

                                                        </ul>
                                                        
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    <!-- End Footer -->
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </div>
    
</body></html>'; ?>