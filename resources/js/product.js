import axios from "axios";
import DOMPurify from "dompurify";

export default function getProduct() {
    const select = document.getElementById("filter-by");
    const inStock = document.getElementById("inStock");
    const outStock = document.getElementById("outStock");
    const contentArea = document.getElementById("collection-page-content");

    // Identificar qual página está ativa
    const isDesignPage = window.location.pathname.includes("design-your-own");
    const isEventPage = window.location.pathname.includes("event");
    const isProductTypePage = window.location.pathname.includes("type");
    const isMaterialPage = window.location.pathname.includes("material");
    const isSizePage = window.location.pathname.includes("size");
    const isShapePage = window.location.pathname.includes("shape");

    select.addEventListener('change', async function() {
        const params = generateParams(); // Gera os parâmetros de filtros
        const link = `${window.location.origin}/collections/${select.value}/raw?${params}`; 
        try {
            const response = await axios.get(link);
            contentArea.innerHTML = DOMPurify.sanitize(response.data.theHTML);
        } catch (error) {
            console.error("Erro ao carregar produtos filtrados:", error);
        }
    });    

    // Estados iniciais
    let inStockProduct = "";
    let outStockProduct = "";
    let selectedColor = "";
    let minPrice = "";
    let maxPrice = "";

    // Função para carregar o conteúdo inicial
    const loadInitialProducts = async () => {
        try {
            const inStockResponse = await axios.get(
                `${window.location.origin}/collections/inStock/raw?${generateParams()}`
            );
            inStockProduct = inStockResponse.data.theHTML;

            const outStockResponse = await axios.get(
                `${window.location.origin}/collections/outStock/raw?${generateParams()}`
            );
            outStockProduct = outStockResponse.data.theHTML;

            // Atualiza o conteúdo com ambos os filtros ativos
            contentArea.innerHTML = DOMPurify.sanitize(
                inStockProduct.concat(outStockProduct)
            );
        } catch (error) {
            console.error("Erro ao carregar produtos iniciais:", error);
        }
    };

    // Carrega os produtos iniciais ao carregar a página
    // window.addEventListener("DOMContentLoaded", loadInitialProducts);

    // Função para gerar os parâmetros da URL com todos os filtros
    const generateParams = () => {
        const params = new URLSearchParams();

        // Adiciona o filtro de "isDesign" (sem valor)
        if (isDesignPage) {
            params.append("isDesign", "true");
        }

        // Captura valores adicionais diretamente do caminho da URL
        const pathParts = window.location.pathname.split('/').filter(Boolean); // Quebra a URL em partes
        const color = pathParts.includes("color") ? pathParts[pathParts.indexOf("color") + 1] : null;
        const type = pathParts.includes("type") ? pathParts[pathParts.indexOf("type") + 1] : null;
        const shape = pathParts.includes("shape") ? pathParts[pathParts.indexOf("shape") + 1] : null;
        const size = pathParts.includes("size") ? pathParts[pathParts.indexOf("size") + 1] : null;
        const material = pathParts.includes("material") ? pathParts[pathParts.indexOf("material") + 1] : null;
        const event = pathParts.includes("event") ? pathParts[pathParts.indexOf("event") + 1] : null;

        // Adiciona os parâmetros de filtro (event, tipo, forma, etc.)
        if (color) params.append("color", color);
        if (type) params.append("type", type);
        if (shape) params.append("shape", shape);
        if (size) params.append("size", size);
        if (material) params.append("material", material);
        if (event) params.append("event", event);  // Agora pegamos o valor de "event" diretamente do caminho

        // Adiciona os filtros de estoque
        params.append("inStock", inStock.checked ? 1 : 0);
        params.append("outStock", outStock.checked ? 1 : 0);

        // Adiciona o filtro de preço, se fornecido
        // if (minPrice && maxPrice) params.append("price", `${minPrice}-${maxPrice}`);

        return params.toString();
    };

    // Carrega os produtos filtrados de acordo com os parâmetros
    const loadFilteredProducts = async (endpoint) => {
        const params = generateParams();

        // Verifica se estamos filtrando por preço
        if (endpoint === "price" && minPrice && maxPrice) {
            // Cria a URL de preço no formato correto
            const priceEndpoint = `price/${minPrice}-${maxPrice}`;
            const link = `${window.location.origin}/collections/${priceEndpoint}/raw?${params}`;
            try {
                const response = await axios.get(link);
                contentArea.innerHTML = DOMPurify.sanitize(response.data.theHTML);
            } catch (error) {
                console.error("Erro ao carregar produtos filtrados:", error);
            }
        } else {
            // Outros filtros
            const link = `${window.location.origin}/collections/${endpoint}/raw?${params}`;
            try {
                const response = await axios.get(link);
                contentArea.innerHTML = DOMPurify.sanitize(response.data.theHTML);
            } catch (error) {
                console.error("Erro ao carregar produtos filtrados:", error);
            }
        }
    };

    // Função para aplicar o filtro de estoque
    const handleStockFilter = async () => {
        // Limpar os outros filtros
        selectedColor = "";
        minPrice = "";
        maxPrice = "";

        // Desmarcar todas as cores
        const colorBox = document.querySelectorAll("#colorBox");
        colorBox.forEach((checkbox) => {
            checkbox.checked = false;
        });

        if (inStock.checked) {
            // Filtra os produtos "Em estoque"
            await loadFilteredProducts("inStock");
        } else if (outStock.checked) {
            // Filtra os produtos "Fora de estoque"
            await loadFilteredProducts("outStock");
        } else {
            // Ambos desmarcados, carrega os produtos iniciais
            await loadInitialProducts();
        }
    };

    // Filtro de "Em estoque"
    inStock.addEventListener("change", async function () {
        // Desmarca o outro filtro
        outStock.checked = false;
        await handleStockFilter();
    });

    // Filtro de "Fora de estoque"
    outStock.addEventListener("change", async function () {
        // Desmarca o outro filtro
        inStock.checked = false;
        await handleStockFilter();
    });

    // Evento para cor
    const colorBox = document.querySelectorAll("#colorBox");
    colorBox.forEach((color) => {
        color.addEventListener("change", async function (e) {
            // Limpa os filtros de estoque e preço
            inStock.checked = false;
            outStock.checked = false;
            minPrice = "";
            maxPrice = "";

            // Desmarcar todas as outras caixas de seleção de cor
            colorBox.forEach((checkbox) => {
                if (checkbox !== e.target) {
                    checkbox.checked = false;
                }
            });

            // Obter a cor marcada (se houver)
            selectedColor = Array.from(colorBox)
                .filter((checkbox) => checkbox.checked)
                .map((checkbox) => checkbox.value)[0];

            await loadFilteredProducts(selectedColor ? `color/${selectedColor}` : "ascending");
        });
    });

    // Aplicar filtro de preço
    const applyButton = document.getElementById("applyPrice");
    applyButton.addEventListener("click", async function () {
        minPrice = document.getElementById("minPrice").value || "1";  // Valor default se vazio
        maxPrice = document.getElementById("maxPrice").value || "999";  // Valor default se vazio

        // Limpa os filtros de estoque e cor
        inStock.checked = false;
        outStock.checked = false;
        selectedColor = "";

        // Desmarcar todas as cores
        const colorBox = document.querySelectorAll("#colorBox");
        colorBox.forEach((checkbox) => {
            checkbox.checked = false;
        });

        // Verifica se ambos os valores de preço foram fornecidos
        if (minPrice && maxPrice) {
            await loadFilteredProducts("price"); // Passa o endpoint 'price' para a função de filtragem
        } else {
            alert("Por favor, insira um preço mínimo e máximo válidos.");
        }
    });
}
