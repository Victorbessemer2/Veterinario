<?php include 'header2.php'; ?>
<!-- O HEADER ORIGINAL FOI MOVIDO PARA header.php -->


<section>
  <div class="container">
    <h2>Seu pet merece o melhor — e a gente cuida disso</h2>
    <p>Na <strong>Clínica Veterinária Patolina</strong>, acreditamos que o cuidado com os animais vai muito além do atendimento: envolve carinho, atenção e compromisso em cada detalhe. Nossa missão é garantir qualidade de vida e bem-estar para o seu melhor amigo, oferecendo atendimento completo com profissionais apaixonados por pets.</p>

    <p>Contamos com uma equipe experiente e equipamentos modernos para oferecer diagnósticos rápidos e tratamentos eficazes. Aqui, cada paciente é tratado com respeito, dedicação e aquele toque de amor que faz toda a diferença.</p>

    <h3>Nossos principais serviços</h3>
    <ul>
      <p>🐾 Consultas de rotina e check-ups completos</p>
      <p>💉 Vacinação e controle de parasitas</p>
      <p>🩺 Exames laboratoriais e diagnósticos por imagem</p>
      <p>⚕️ Cirurgias com monitoramento seguro</p>
      <p>🍖 Nutrição e acompanhamento de peso</p>
      <p>❤️ Atendimento emergencial e cuidados intensivos</p>
    </ul>

    <h3>Seu pet em boas mãos</h3>
    <p>Seja para uma simples vacina, um exame detalhado ou uma consulta de emergência, estamos prontos para cuidar do seu companheiro com o máximo de atenção. Na Patolino, cada pet é tratado como parte da nossa família.</p>

    <p><strong>Agende uma visita</strong> e descubra porque somos referência em cuidado, confiança e amor pelos animais.</p>

    <a href="cadastro_cliente.php" class="btn">Agendar Agora</a><br>

  </div>
</section>

<?php include 'footer.php'; ?>
<!-- FOOTER ORIGINAL FOI MOVIDO PARA footer.php -->

<script>
const menuLinks = document.querySelectorAll('.menu a');
const menuToggle = document.getElementById('menu-toggle');
menuLinks.forEach(link => {
    link.addEventListener('click', () => { menuToggle.checked = false; });
});
</script>

