
function mascaraDocumento(input) {
    let valor = input.value.replace(/\D/g, ''); 
    let tamanho = valor.length;

    
    if (tamanho <= 11) {
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    } 
    
    else if (tamanho <= 14) {
        valor = valor.replace(/^(\d{2})(\d)/, '$1.$2');
        valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        valor = valor.replace(/\.(\d{3})(\d)/, '.$1/$2');
        valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
    }

    input.value = valor;
}


document.addEventListener('DOMContentLoaded', function() {
    console.log('Máscaras JS carregado!');
    const campoDocumento = document.getElementById('documento');
    if (campoDocumento) {
        console.log('Campo documento encontrado');
        
        mascaraDocumento(campoDocumento);
        
        campoDocumento.addEventListener('input', function() {
            mascaraDocumento(this);
        });
    } else {
        console.log('Campo documento NÃO encontrado');
    }
});


function mascaraMoeda(input) {
    let valor = input.value;
    
    valor = valor.replace(/\D/g, '');
    
    valor = valor.padStart(3, '0');
    
    let inteiro = valor.slice(0, -2);
    let centavos = valor.slice(-2);
    
    inteiro = inteiro.replace(/^0+/, '') || '0';
    
    inteiro = inteiro.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    
    input.value = inteiro + ',' + centavos;
}


function mascaraPeso(input) {
    let valor = input.value;
   
    valor = valor.replace(/\D/g, '');
    
    valor = valor.padStart(4, '0');
    
    let inteiro = valor.slice(0, -3);
    let decimais = valor.slice(-3);
    
    inteiro = inteiro.replace(/^0+/, '') || '0';
    
    inteiro = inteiro.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    
    input.value = inteiro + ',' + decimais;
}


document.addEventListener('DOMContentLoaded', function() {
    const campoValor = document.getElementById('valorVenda');
    const campoPesoBruto = document.getElementById('pesoBruto');
    const campoPesoLiquido = document.getElementById('pesoLiquido');

    if (campoValor) {
        campoValor.addEventListener('input', function() {
            mascaraMoeda(this);
        });
    }

    if (campoPesoBruto) {
        campoPesoBruto.addEventListener('input', function() {
            mascaraPeso(this);
        });
    }

    if (campoPesoLiquido) {
        campoPesoLiquido.addEventListener('input', function() {
            mascaraPeso(this);
        });
    }
});