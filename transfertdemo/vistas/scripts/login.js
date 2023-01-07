$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    ap=$("#app").val();
    password=$("#passwordd").val();

    $.post("../ajax/ajax_usuarios.php?op=verificar",
        {"ap":ap,"password":password},
        function(data)
    {

        if (data!="null")
        {

            $(location).attr("href","escritorio.php");            
        }
        else
        {

            bootbox.alert("Usuario y/o Password incorrectos");
        }
    });
})