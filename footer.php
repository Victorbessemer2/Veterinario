<footer class="footer">
    <p>© 2025 VetCare - Todos os direitos reservados</p>
</footer>

<script>
// Script do menu hambúrguer
const menuLinks = document.querySelectorAll('.menu a');
const menuToggle = document.getElementById('menu-toggle');
menuLinks.forEach(link => {
    link.addEventListener('click', () => { menuToggle.checked = false; });
});
</script>

</body>
</html>
