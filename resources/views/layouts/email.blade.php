<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0; font-family: 'Open Sans', sans-serif;">
<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; text-align: center; margin-top: 16px; margin-bottom: 16px; border: 1px solid #E5E5E5; table-layout: fixed">
    <tr>
        <td bgcolor="#FFFFFF" style="height: 112px; vertical-align: middle">
            <img src="@yield('logo')" width="100">
        </td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF" style="padding: 42px 0px 32px 0; font-size: 20px; font-weight: bold; color: #000000;">
            @yield('titulo')
        </td>
    </tr>
    <tr>
        <td style="background-color: #FFFFFF; height: 115px; vertical-align: middle; font-size: 15px; font-weight: bold; color: #000000; padding: 0 100px; margin-bottom: 12px;">
            @yield('descricao')
        </td>
    </tr>
    @yield('conteudo')
</table>
</body>
</html>
