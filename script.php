<?php
   header('Access-Control-Allow-Origin:')
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário e montar em um array
    $dados = [
        "estado_civil" => $_POST["estado_civil"],
        "ordem_de_inscricao" => $_POST["ordem_de_inscricao"],
        "curso" => $_POST["curso"],
        "horario_diurno_noturno" => $_POST["horario_diurno_noturno"],
        "qualificacao_previa" => $_POST["qualificacao_previa"], 
        "nota_obtida_na_qualificacao_anterior" => $_POST["nota_obtida_na_qualificacao_anterior"], 
        "nacionalidade" => $_POST["nacionalidade"], 
        "escolaridade_da_mae" => $_POST["escolaridade_da_mae"],
        "escolaridade_do_pai" => $_POST["escolaridade_do_pai"],
        "ocupacao_da_mae" => $_POST["ocupacao_da_mae"],
        "ocupacao_do_pai" => $_POST["ocupacao_do_pai"],
        "nota_de_admissao" => $_POST["nota_de_admissao"],
        "necessidades_educacionais_especiais" => $_POST["necessidades_educacionais_especiais"],
        "devedor" => $_POST["devedor"],
        "mensalidade_em_dia" => $_POST["mensalidade_em_dia"],
        "genero" => $_POST["genero"],
        "bolsista" => $_POST["bolsista"],
        "idade_no_momento_da_matricula" => $_POST["idade_no_momento_da_matricula"],
        "internacional" => $_POST["internacional"],
        "unidades_curriculares_1_semestre_inscrito" => $_POST["unidades_curriculares_1_semestre_inscrito"],
        "unidades_curriculares_no_1_semestre_aprovado" => $_POST["unidades_curriculares_no_1_semestre_aprovado"],
        "unidades_curriculares_2_semestre_inscrito" => $_POST["unidades_curriculares_2_semestre_inscrito"],
        "unidades_curriculares_no_2_semestre_aprovado" => $_POST["unidades_curriculares_no_2_semestre_aprovado"]
    ];

    // Chave de autenticação para a API Python
    $api_key = 'kRaUahLJqJINbgbmIS7vYnTHq3u36Nu3';  // Substitua pela sua chave de autenticação real

    // Opções para a solicitação POST, incluindo a chave de autenticação no cabeçalho
    $options = [
        'http' => [
            'header' => 'Content-Type: application/json' . "\r\n" .
                        'Authorization: Bearer ' . $api_key,
            'method' => 'POST',
            'content' => json_encode($dados)
        ]
    ];
    
    // Enviar dados para a API Python
    $url = 'http://81997ade-a1ac-4252-82da-2cd1629ebb1a.southcentralus.azurecontainer.io/score';  // Substitua pela URL da sua API
    
    $context = stream_context_create($options);
    $resultado_api = file_get_contents($url, false, $context);

    // Analisar a resposta JSON
    $resultado = json_decode($resultado_api, true);
    
    // Verificar a previsão
    if ($resultado["previsao"] == 1) {
        $status_evasao = "Evasão";
    } else {
        $status_evasao = "Não evadido";
    }
}
?>