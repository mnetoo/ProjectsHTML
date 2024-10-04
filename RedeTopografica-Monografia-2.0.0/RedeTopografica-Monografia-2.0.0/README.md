# Versionamento Semântico (Como usar?)
Se a estrutura do projeto mudou completamente e não se trata apenas de uma pequena alteração, o número da versão deve refletir essa mudança significativa. Aqui estão as diretrizes gerais para versionamento, seguindo o padrão [SemVer (Versionamento Semântico)](https://semver.org/):

1. **A versão principal (Major)** deve ser incrementada quando há mudanças que quebram a compatibilidade anterior, como uma reestruturação completa do código, alterações fundamentais na API, ou mudanças que requerem que os usuários façam ajustes consideráveis em seus sistemas para continuar usando o software.

2. **A versão secundária (Minor)** deve ser incrementada para adicionar novas funcionalidades de maneira compatível com versões anteriores. Mudanças menores, que não afetam a compatibilidade, são refletidas aqui.

3. **A versão de correção (Patch)** é incrementada para correções de bugs ou pequenas melhorias que não adicionam novas funcionalidades nem afetam a compatibilidade.

### Exemplo:

- Se sua aplicação estava na versão **1.0.0** e a estrutura mudou completamente, você deve aumentar a versão principal:
  - De **1.0.0** para **2.0.0**.

Isso indica aos usuários que houve uma mudança significativa que pode quebrar a compatibilidade com a versão anterior.
