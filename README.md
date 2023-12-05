# Peripherals 

Bem-vindo ao Peripherals, o seu destino para encontrar periféricos de computador de alta qualidade para aprimorar sua experiência de uso!

Somos um ecommerce especializado em teclados, mouses, headsets, monitores e cadeiras para gamers, profissionais e estudantes que buscam o melhor desempenho em suas tarefas. Temos o compromisso de oferecer aos nossos clientes os melhores produtos do mercado, com as marcas mais conceituadas e as tecnologias mais inovadoras.

Nosso site é fácil de usar e navegar, e oferecemos uma grande variedade de produtos para atender a todas as suas necessidades. Se você é um jogador ávido, um estudante dedicado ou um profissional diligente e está busca do melhor desempenho, nós temos o produto perfeito para você. Além disso, oferecemos opções de frete rápido e seguro para que você possa receber seus produtos rapidamente e sem complicações.

Nosso objetivo é oferecer um atendimento ao cliente excepcional. Nossa equipe está sempre disponível para ajudá-lo com qualquer dúvida ou problema que possa surgir. Valorizamos nossos clientes e estamos empenhados em fornecer um excelente serviço a cada um deles.

No Peripherals, estamos constantemente atualizando nosso catálogo de produtos com as últimas novidades do mercado, para que você possa sempre encontrar o que há de mais moderno e atualizado. Com nossa vasta seleção de periféricos de computador, estamos confiantes de que você encontrará exatamente o que precisa para melhorar sua experiência de uso.

Agradecemos por escolher o Peripherals como sua fonte confiável de periféricos de computador. Estamos ansiosos para ajudá-lo a encontrar o produto perfeito para suas necessidades.

<br>


O projeto "Peripherals" é um e-commerce de periféricos para PC desenvolvido como TCC na ETEC Jornalista Roberto Marinho. Utilizando Laravel como linguagem principal, a aplicação integra MySQL e JavaScript. Os designs foram concebidos com Figma, Photoshop e Adobe XD, proporcionando uma experiência visualmente cativante e funcional.  <br>

<br>

## Equipe

**Samuel Freitas (Front-end e Designer)**: https://www.linkedin.com/in/samuel-freitas-02ba27226/ <br>
**Thiago Inácio (Front-end e Designer)**: https://www.linkedin.com/in/thiago-inacio-473083269/ <br>
**Sophia Vieira (Front-End)**: https://www.linkedin.com/in/sophia-santos-16a031269/ <br>
**Giovanna Capozzoli (Gerente e Documentadora)**: https://www.linkedin.com/in/giovanna-capozzoli-martins-a6474721a/ <br>
**Kathleen Gomes (Documentadora)**: https://www.linkedin.com/in/kathleen-oliveira-55818026a/ <br>
**Davi Moreira (Back-End e DBA)**: https://www.linkedin.com/in/davimoreiraprogrammer/ <br>

<br>

## Script criação de usuários

Usuário: NaoApague <br>
Email: admin@admin.com <br>
Senha: Gizona123@ <br>

Usuário: Administrador <br>
Email: admin@admin.com <br>
Senha: Gizona123@ <br>

Usuário: Davi <br>
Email: Davi@adm.com <br>
Senha: Sardinha@123 <br>

# Inserir ao passar para a nova hospedagem

INSERT INTO users_venda_status (status_venda, created_at, updated_at)
VALUES ('Pendente', NOW(), NOW());

INSERT INTO users_venda_status (status_venda, created_at, updated_at)
VALUES ('Em Processamento', NOW(), NOW());

INSERT INTO users_venda_status (status_venda, created_at, updated_at)
VALUES ('Confirmada', NOW(), NOW());

INSERT INTO users_venda_status (status_venda, created_at, updated_at)
VALUES ('Em Preparação', NOW(), NOW());

INSERT INTO users_venda_status (status_venda, created_at, updated_at)
VALUES ('Enviada', NOW(), NOW());

INSERT INTO users_venda_status (status_venda, created_at, updated_at)
VALUES ('Concluído', NOW(), NOW());


INSERT INTO adm_users(name, email, email_verified_at, password, poder, status, remember_token, created_at, updated_at) VALUES ('Davi', 'Davi@adm.com', NOW(), '$2a$10$9B3KgKtg3YpK4cwBibyKlu6APqkgpu8h/LeCQHvwhLf194Zmw25..', 9, 1, 'QDASDIAHU', NOW(), NOW()); 
