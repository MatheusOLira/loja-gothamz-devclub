<?php session_start(); ?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="./img/favicon.png" type="image/png">
    <title>Store - GothamZ</title>
    <link rel="stylesheet" href="./css/store.css" />
</head>

  <body>
    <header class="header" id="topo">
      <nav class="navbar">
        <div class="container">
          <div class="nav-brand">
            <img class="nav-logo" src="./img/logo.png" alt="GothamZ">
          </div>
          <ul class="nav-menu">
            <li><a href="#home" class="nav-link">Início</a></li>
            <li><a href="#produtos" class="nav-link">Produtos</a></li>
            <li><a href="#sobre" class="nav-link">Sobre</a></li>
            <li><a href="#contato" class="nav-link">Contato</a></li>
            <?php if(isset($_SESSION['steamid'])): ?>
              <li><a href="painel.php" class="nav-link">Meu Painel</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['steamid'])): ?>
            <li style="display:flex;align-items:center;gap:10px;">
                <img src="<?= $_SESSION['steam_avatar'] ?>" width="30" style="border-radius:50%;">
                <span style="color:#0e72fc;"><?= $_SESSION['steam_name'] ?></span>
                
                <a href="logout.php" style="color:red; margin-left:10px; text-decoration:none;">Sair</a>
            </li>
            <?php else: ?>
                <li><a href="steam_login.php" class="nav-link">Login com Steam</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </nav>
    </header>

    <section class="banner" id="home">
      <div class="banner-img">
        <h1>Gotham<span style="color:red;">Z</span> Dayz</h1>
        <p>Sobreviva no mundo pós-apocalíptico!</p>
      </div>
      
    </section>

    <section class="products" id="produtos">
      <div class="container">
        <h2 class="section-title">Nossos Pacotes</h2>
        <p class="section-subtitle">Seleção especial de Coins</p>

        <div class="products-grid">
          <div class="product-card">
            <div class="product-image">
              <img src="./img/coins.png" alt="Coins">
            </div>
            <div class="product-info">
              <h3 class="product-title">1000 Coins</h3>
              <p class="product-description">Adicione 1000 GzCoins a sua conta <br> + Cargo <span class="apoiador">Apoiador</span> no Discord.</p>
              <p style="font-size:12px; color:#aaa;">
                Ao comprar você concorda com nossos 
                <a href="termos.php" target="_blank">Termos de Uso</a> e 
                <a href="privacidade.php" target="_blank">Política de Privacidade</a>
                </p>
              <div class="product-footer">
                <span class="product-price">R$ 10,00</span>
                <button class="btn btn-secondary" onclick="comprar(1)">Comprar</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-image">
              <img src="./img/coins.png" alt="Coins">
            </div>
            <div class="product-info">
              <h3 class="product-title">2000 Coins</h3>
              <p class="product-description">Adicione 2000 GzCoins a sua conta <br> + Cargo <span class="apoiador">Apoiador</span> no Discord.</p>
              <p style="font-size:12px; color:#aaa;">
                Ao comprar você concorda com nossos 
                <a href="termos.php" target="_blank">Termos de Uso</a> e 
                <a href="privacidade.php" target="_blank">Política de Privacidade</a>
                </p>
              <div class="product-footer">
                <span class="product-price">R$ 20,00</span>
                <button class="btn btn-secondary" onclick="comprar(2)">Comprar</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-image">
              <img src="./img/coins.png" alt="Coins">
            </div>
            <div class="product-info">
              <h3 class="product-title">3000 Coins</h3>
              <p class="product-description">Adicione 3000 GzCoins a sua conta <br> + Cargo <span class="apoiador">Apoiador</span> no Discord.</p>
              <p style="font-size:12px; color:#aaa;">
                Ao comprar você concorda com nossos 
                <a href="termos.php" target="_blank">Termos de Uso</a> e 
                <a href="privacidade.php" target="_blank">Política de Privacidade</a>
                </p>
              <div class="product-footer">
                <span class="product-price">R$ 30,00</span>
                <button class="btn btn-secondary" onclick="comprar(3)">Comprar</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-image">
              <img src="./img/coins.png" alt="Coins">
            </div>
            <div class="product-info">
              <h3 class="product-title">5500 Coins</h3>
              <p class="product-description">Adicione 5500 GzCoins a sua conta <br> + Cargo <span class="apoiador">Apoiador</span> no Discord.</p>
              <p style="font-size:12px; color:#aaa;">
                Ao comprar você concorda com nossos 
                <a href="termos.php" target="_blank">Termos de Uso</a> e 
                <a href="privacidade.php" target="_blank">Política de Privacidade</a>
                </p>
              <div class="product-footer">
                <span class="product-price">R$ 50,00</span>
                <button class="btn btn-secondary" onclick="comprar(4)">Comprar</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-image">
              <img src="./img/coins.png" alt="Coins">
            </div>
            <div class="product-info">
              <h3 class="product-title">11500 Coins</h3>
              <p class="product-description">Adicione 11500 GzCoins a sua conta <br> + Cargo <span class="apoiador">Apoiador</span> no Discord.</p>
              <p style="font-size:12px; color:#aaa;">
                Ao comprar você concorda com nossos 
                <a href="termos.php" target="_blank">Termos de Uso</a> e 
                <a href="privacidade.php" target="_blank">Política de Privacidade</a>
                </p>
              <div class="product-footer">
                <span class="product-price">R$ 100,00</span>
                <button class="btn btn-secondary" onclick="comprar(5)">Comprar</button>
              </div>
            </div>
          </div>

          <div class="product-card">
            <div class="product-image">
              <img src="./img/coins.png" alt="Coins">
            </div>
            <div class="product-info">
              <h3 class="product-title">17500 Coins</h3>
              <p class="product-description">Adicione 17500 GzCoins a sua conta <br> + Cargo <span class="apoiador">Apoiador</span> no Discord.</p>
              <p style="font-size:12px; color:#aaa;">
                Ao comprar você concorda com nossos 
                <a href="termos.php" target="_blank">Termos de Uso</a> e 
                <a href="privacidade.php" target="_blank">Política de Privacidade</a>
                </p>
              <div class="product-footer">
                <span class="product-price">R$ 150,00</span>
                <button class="btn btn-secondary" onclick="comprar(6)">Comprar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="about" id="sobre">
      <div class="container">
        <div class="about-content">
          <div class="about-text">
            <h2 class="section-title-sobre">Sobre Nós</h2>
            <p>Desde 2023, nossos servidores de DayZ vem proporcionando uma experiência sólida e diferenciada para os amantes do modo PvE. Focado em exploração, progressão e sobrevivência, o servidor foi desenvolvido para jogadores que buscam um ambiente mais tranquilo, sem a presença de PvP.</p>
            <p>Com a adição de sistemas de bots inteligentes, o desafio permanece constante, enquanto os farms garantem oportunidades de evolução contínua, recompensas e desenvolvimento do personagem.</p>
            <p>Nosso compromisso é manter um servidor estável, otimizado e em constante evolução, oferecendo sempre a melhor experiência para a comunidade.</p>
            <div class="about-features">
              <div class="feature-item">
                <h3>500+</h3>
                <p>Membros no Discord</p>
              </div>
              <div class="feature-item">
                <h3>2</h3>
                <p>Servidores Disponíveis</p>
              </div>
              <div class="feature-item">
                <h3>24h</h3>
                <p>Online</p>
              </div>
            </div>
          </div>
          <div class="about-image">
            <img src="./img/dayz.png" alt="DayZ">
          </div>
        </div>
      </div>
    </section>

    <section class="servers">
      <h1 class="section-title-servidores">Servidores</h1> 
      <p class="section-subtitle-servidores">Dayz servers</p>

      <div class="servers-grid">
      <script type="application/javascript">window.addEventListener('message',function(e){if(e.data.uid&&e.data.type==='sizeUpdate'){var i = document.querySelector('iframe[name="'+e.data.uid+'"]');i.style.width = e.data.payload.width;i.style.height = e.data.payload.height;}});</script><iframe src="https://cdn.battlemetrics.com/b/standardVertical/37120881.html?foreground=%23EEEEEE&linkColor=%231185ec&lines=%23333333&background=%23222222&chart=players%3A24H&chartColor=%23FF0700&maxPlayersHeight=300" frameborder=0 style="border:0" name="ubkus"></iframe>

      <script type="application/javascript">window.addEventListener('message',function(e){if(e.data.uid&&e.data.type==='sizeUpdate'){var i = document.querySelector('iframe[name="'+e.data.uid+'"]');i.style.width = e.data.payload.width;i.style.height = e.data.payload.height;}});</script><iframe src="https://cdn.battlemetrics.com/b/standardVertical/37954433.html?foreground=%23EEEEEE&linkColor=%231185ec&lines=%23333333&background=%23222222&chart=players%3A24H&chartColor=%23FF0700&maxPlayersHeight=300" frameborder=0 style="border:0" name="ueqof"></iframe>
      </div>

    </section>

    <section class="contact" id="contato">
      <div class="container">
        <h2 class="section-title-contato">Entre em Contato</h2>
        <p class="section-subtitle-contato">Tire suas dúvidas ou envie suas sugestões</p>
        <a href="https://discord.gg/qtD6puxtDS" target="_blank"><img src="./img/discord.png" alt=""></a>
        
      </div>
    </section>

    <footer class="footer">
      <div class="container">
        <div class="footer-content">
          <div class="footer-section">
            <h3>Loja Digital</h3>
            <p>Sua Loja digital com entrega automatica.</p>
          </div>

          <div class="footer-section">
            <h4>Links Rápidos</h4>
            <ul class="footer-links">
              <li><a href="#home">Início</a></li>
              <li><a href="#produtos">Produtos</a></li>
              <li><a href="#sobre">Sobre Nós</a></li>
              <li><a href="#contato">Contato</a></li>
            </ul>
          </div>

          <div class="footer-section">
            <h4>Informações</h4>
            <ul class="footer-links">
              <li><a href="privacidade.php">Política de Privacidade</a></li>
              <li><a href="termos.php">Termos de Uso</a></li>
              <li><a href="#contato">Suporte</a></li>
            </ul>
          </div>

          <div class="footer-section">
            <h4>Contato</h4>
            <p>Email: batiminhasv@gmail.com</p>
          </div>
        </div>

        <div class="footer-bottom">
          <p>&copy; 2026 Loja Digital. Todos os direitos reservados.</p>
        </div>
      </div>
    </footer>

  <script>
    const usuarioLogado = <?php echo isset($_SESSION['steamid']) ? 'true' : 'false'; ?>;
  </script>

  <script src="./script.js"></script>
  </body>
</html>
