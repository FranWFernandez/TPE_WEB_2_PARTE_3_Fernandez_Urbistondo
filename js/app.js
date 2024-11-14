"use strict";

const BASE_URL = 'api/';

let products = [];


async function getAll() {
    try {
        const response = await fetch(BASE_URL + "productos");
        if(!response.ok) {
            throw new Error('Error al llamado de productos');
        }
        products = await response.json();
        showProducts();
    } catch (error) {
        console.log(error);
    }
}

function showProducts() {
    let section = document.querySelector("#home");
    section.innerHTML = "";
    
    for(const product of products) {
        let html = `
        <div class="container-fluid">
            <div class="row">
                    <div class="col-md-4 mb-4 text-center">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text" id="listado">${product.nombre}</p>
                                <a  class="btn btn-secondary btn-lg">Ver Mas</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>`;
        section.innerHTML += html;
    }
}

getAll();