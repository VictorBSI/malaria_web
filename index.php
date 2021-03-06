<?php 
    include('dbcon.php');
    //$reference = $database->getReference('malaria');
    //echo $reference->getValue();
?>

<?php


$con=mysqli_connect("localhost","root","hugo15","malaria");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"select usuario.nome, usuario.codigo, date_format(usuario.data_nascimento, '%d/%m/%Y') as data_nascimento,
usuario.sexo, usuario.endereco,
concat('<strong>A casa onde você mora é?</strong>', '<br> ',  user_casa.resposta, '<br><br>',
'<strong>Qual o tipo de malária você foi diagnosticado?</strong>', '<br>', user_diagnostico.resposta, '<br><br>',
'<strong>Como o agente de saúde lhe recomendou tomar o remédio?</strong>', '<br>', user_agentes.resposta, '<br><br>',
'<strong>Qual a sua escolaridade?</strong>', '<br>', user_escolaridade.resposta, '<br><br>',
'<strong>Recebeu orientações para evitar o consumo de bebida alcoólica durante o tratamento?</strong>', '<br>',
user_evitar.resposta_1, '<br><br>',
'<strong>Recebeu outras informações sobre a malária, além das orientações sobre o tratamento?</strong>', '<br>',
user_evitar.resposta_2, '<br><br>',
'<strong>O dia para o seu retorno foi previamente agendado para a realização das lâminas de controle de cura?</strong>', '<br>',
user_cura.resposta_1, '<br><br>', 
'<strong>Você foi informado por que é feito esse controle de verificação de cura?</strong>', '<br>',
user_cura.resposta_2, '<br><br>', '<strong>Data</strong>', '<br>', date_format(user_cura.data, '%d/%m/%Y'), '<br><br>',
'<strong>Quando teve malária, tomou os comprimidos do jeito que o profissional de saúde lhe orientou?</strong>', '<br>',
user_comprimidos.resposta, '<br><br>', '<strong>Explique:</strong>', '<br>', user_comprimidos.explique, '<br><br>',
'<strong>Quando se sente bem, para de tomar os remédios?</strong>', '<br>',
user_bem.resposta
) as resposta
FROM malaria.usuario usuario
INNER JOIN malaria.user_agentes user_agentes ON usuario.codigo = user_agentes.usuario  
inner join malaria.user_bem user_bem on user_bem.usuario = user_agentes.usuario 
inner join malaria.user_casa user_casa on user_casa.usuario = usuario.codigo 
inner join malaria.user_comprimidos user_comprimidos on user_comprimidos.usuario = usuario.codigo 
inner join malaria.user_cura user_cura on user_cura.usuario = usuario.codigo 
inner join malaria.user_diagnostico user_diagnostico on user_diagnostico.usuario = usuario.codigo 
inner join malaria.user_escolaridade user_escolaridade on user_escolaridade.usuario = usuario.codigo 
inner join malaria.user_evitar user_evitar on user_evitar.usuario = user_escolaridade.usuario; ");





//$malaria = '';

$css = file_get_contents('style.css');

echo '<!DOCTYPE html>';
echo '<html>';
echo '<head>';
echo '<style>';
echo $css;
echo '</style>';
echo '</head>';
echo '<body>';
if(isset($_SESSION['status'])){
    echo "<h4 class='alert alert-success'>".$_SESSION['status']."</h4>";            
    unset($_SESSION['status']);
}
echo '';
$arrCombo = array(
    "1" => "P. vivax",
    "2" => "Plasmodium falciparum",
    "3" => "P.malariae",
    "4" => "Mista",
    "5" => "Desconheco",
    "6" => "Prefiro nao responder"
);
$valor_selecionado = "1";
$output = "";

echo '<form name="form1" action="index.php" method="post">';
echo '<label>Tipo Malária: </label>';
echo '<select name="malaria" onchange="javascript= document.form1.submit();">';
echo '<option>Todos</option>';
foreach ($arrCombo as $key => $value):
    $selected = ($_REQUEST['malaria'] == $key) ? "selected=\"selected\"": null;
    echo "<option value=\"$key\"  $selected>$value</option>";      
endforeach;
echo '</select>';
echo '</form>';
$output = isset($_REQUEST['malaria'])?$_REQUEST['malaria']:null;
$vtipo = '';
foreach ($arrCombo as $key => $value):
    if($output == $key){
         $vtipo = $value;   
    }
endforeach;
echo '';
#echo $output;
echo '';
echo '<div class="row">';
echo '<div class="column">';
echo "<table border='1'>
<tr>
<th class='paciente'>Paciente</th>
<th class='quest'>Questionário</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";

$result2 = mysqli_query($con,"select usuario.nome, usuario.codigo, concat('<strong>Onde a sua casa está localizada?</strong>', '<br>',  user_localizada.resposta, '<br><br>',
'<strong>Qual a sua ocupação atual?</strong>', '<br>', user_ocupacao.resposta, '<br><br>',
'<strong>Quais orientações recebeu em relação ao tratamento?</strong>', '<br>', user_orientacao.resposta, '<br><br>',
'<strong>Não tomou os comprimidos por qual motivo?</strong>', '<br>', user_motivo.resposta, '<br><br>',
'<strong>Quais orientações você consegue seguir?</strong>', '<br>', user_seguir.resposta, '<br><br>',
'<strong>Quais orientações você não consegue seguir?</strong>', '<br>', user_naoseguir.resposta, '<br><br>',
'<strong>Quando se sente mal após tomar os remédios, para de tomar?</strong>', '<br>', user_mal.resposta
) as resposta
from malaria.usuario usuario
inner join malaria.user_localizada user_localizada on user_localizada.usuario = usuario.codigo 
inner join malaria.user_mal user_mal on user_mal.usuario = usuario.codigo 
inner join malaria.user_motivo user_motivo on user_motivo.usuario = usuario.codigo 
inner join malaria.user_naoseguir user_naoseguir on user_naoseguir.usuario = usuario.codigo 
inner join malaria.user_ocupacao user_ocupacao on user_ocupacao.usuario = usuario.codigo 
inner join malaria.user_orientacao user_orientacao on user_orientacao.usuario = usuario.codigo
inner join malaria.user_seguir user_seguir on user_seguir.usuario = usuario.codigo
; ");



while($row2 = mysqli_fetch_array($result2))
{
    $result3 = mysqli_query($con, "select usuario.nome, usuario.codigo, user_tipo.resposta as tipo, concat('<strong>Quantas vezes você já teve malária?</strong>', 
    '<br>', user_vezes.resposta, '<br><br>', '<strong>Qual o tipo de malária você teve?</strong>', '<br>',
    user_tipo.resposta, '<br><br>',
    '<strong>Quanto tempo faz desde a última malária? (meses)</strong>', '<br>', user_tempo.meses, '<br><br>',
    '<strong>Você costuma informar ao profissional de saúde quando alguém do seu convívio está com suspeita de malária?</strong>', '<br>',
    user_tempo.resposta_1, '<br><br>',
    '<strong>Além de você, tem alguém com malária na sua família neste momento?</strong>', '<br>',
    user_tempo.resposta_2, '<br><br>', '<strong>Quem?</strong>', '<br>', user_tempo.quem, '<br><br>',
    '<strong>O que fez com os comprimidos que sobraram?</strong>', '<br>', user_sobraram.resposta, '<br><br>',
    '<strong>Já esqueceu de tomar os remédios?</strong>', '<br>', user_remedio.resposta
    ) as resposta  
    FROM malaria.usuario usuario 
    inner join malaria.user_sobraram user_sobraram on user_sobraram.usuario = usuario.codigo 
    inner join malaria.user_tempo user_tempo on user_tempo.usuario = usuario.codigo 
    inner join malaria.user_tipo user_tipo on user_tipo.usuario = usuario.codigo 
    inner join malaria.user_vezes user_vezes on user_vezes.usuario = usuario.codigo
    inner join malaria.user_remedio user_remedio on user_remedio.usuario = usuario.codigo
    ; ");
    while($row3 = mysqli_fetch_array($result3)){
        if($row['codigo'] == $row2['codigo'] && $row['codigo'] == $row3['codigo'] && $row2['codigo'] == $row3['codigo'] && (empty($output) || $output == "Todos")){
            echo "<td> 
            <b>Nome:</b> " . $row['nome'] . 
            "<p><b>Código:</b> " . $row['codigo'] .
            "<p><b>Data de Nascimento:</b> " . $row['data_nascimento'] .
            "<p><b>Sexo:</b> " . $row['sexo'] .
            "<p><b>Endereço:</b> " . $row['endereco'] .
            "</td>";
            echo "<td>" . $row['resposta'] . 
            "<p>" . $row2['resposta'] . 
            "<p>" . $row3['resposta'] .
            "</td>";
            echo "</tr>";
        } else if($row['codigo'] == $row2['codigo'] && $row['codigo'] == $row3['codigo'] && $row2['codigo'] == $row3['codigo'] && $vtipo == $row3['tipo']){
            echo "<td> 
            <b>Nome:</b> " . $row['nome'] . 
            "<p><b>Código:</b> " . $row['codigo'] .
            "<p><b>Data de Nascimento:</b> " . $row['data_nascimento'] .
            "<p><b>Sexo:</b> " . $row['sexo'] .
            "<p><b>Endereço:</b> " . $row['endereco'] .
            "</td>";
            echo "<td>" . $row['resposta'] . 
            "<p>" . $row2['resposta'] . 
            "<p>" . $row3['resposta'] .
            "</td>";
        }
        echo "</tr>";
        
        }
}


}


echo "</table></br>";
echo '</div>';
echo '</div>';
echo '';
echo '</body>';
echo '</html>';
echo '';
mysqli_close($con);
?>

