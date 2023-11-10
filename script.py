from flask import Flask, request, jsonify
from flask_cors import CORS
import requests 

app = Flask(__name__)

chave_autenticacao = 'kRaUahLJqJINbgbmIS7vYnTHq3u36Nu3'
@app.route('/receber_dados', methods=['POST'])
def receber_dados():
    try:

        chave_autenticacao_recebida = request.headers.get('Authorization')
        if chave_autenticacao_recebida != f'Bearer {chave_autenticacao}':
            return jsonify({"error": "Chave de autenticação inválida"}), 401
        # Recebe os dados JSON da solicitação POST
        dados = request.json
        
        # Execute o código para fazer previsões ou processar os dados aqui
        # Substitua este exemplo pelo código real que você precisa executar
        modelo_url = 'http://81997ade-a1ac-4252-82da-2cd1629ebb1a.southcentralus.azurecontainer.io/score'  # URL do modelo
        response = requests.post(modelo_url, json=dados)  # Envie os dados ao modelo
        resultado = {}  # Aqui você pode colocar a lógica para processar os dados
        
        # Retorna a resposta JSON
        return jsonify(resultado)
    except Exception as e:
        return jsonify({"error": str(e)})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
