<style>
.message {
  background-color: #f8f9fa;
  padding: 20px;
  border: 1px solid #dee2e6;
  border-radius: 5px;
  text-align: center;
  max-width: 400px;
  margin: 0 auto;
}

.message p {
  margin-bottom: 10px;
}

.message img {
  max-width: 100%;
  height: auto;
  margin-bottom: 10px;
}

.message a.btn {
  text-decoration: none;
  display: inline-block;
  background-color: #007bff;
  color: #fff;
  padding: 8px 16px;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.message a.btn:hover {
  background-color: #0056b3;
}
</style>

<div class="message">
  <p>Su pedido fue entregado a su destino. Por favor, espere un plazo de 24 horas para una respuesta.</p>
  <img src="./imagenes/enviado.jpg" alt="Archivo enviado">
  <br>
  <p>Su archivo fue recibido por: <?php $kard=$_GET['usuario']; echo $kard;?></p>
  <br>
  <a href="bandejaE.php" class="btn">Volver a la bandeja de entrada</a>
</div>
