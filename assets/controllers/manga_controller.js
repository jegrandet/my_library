//import { Controller } from '@hotwired/stimulus';
import './../app.js';
import DataTable from 'datatables.net-bs5';
import languageFR from 'datatables.net-plugins/i18n/fr-FR.mjs';
 import { Modal } from 'bootstrap'


/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
let datatable = null;

document.addEventListener("DOMContentLoaded", function (event) {
    initDatatable();
    initEvent();
});

function initDatatable(){
    var dataSrc = document.getElementById("table_series").dataset.src;
    datatable = new DataTable('#table_series', {
        language: languageFR,
        ajax: dataSrc,
        dataType: "json",
        dataSrc: "",
        columns: [
            {data: 'titre'},
            {data: 'titreVo'},
            {data: 'titreTraduit'},
            {
                data: 'nombreTomeVo',
                render: function (data, type, row, meta) {
                    if(type === 'display'){
                        return row["nombreTomeVo"] + " (" + row["statutVo"] + ')';
                    }
                    return row["nombreTomeVo"];
                }
            },
            {
                data: 'nombreTomeVf',
                render: function (data, type, row, meta) {
                    if(type === 'display'){
                        return row["nombreTomeVf"] + " (" + row["statutVf"] + ")";
                    }
                    return row["nombreTomeVf"];
                }
            },
            {
                data: 'source',
                render: function (data, type, row, meta) {
                    if(type === 'display'){
                        return '<a href="' + data + '" target="_blank"><i class="fa-solid fa-up-right-from-square"></i></a>';
                    }
                    return data;
                }
            },
            {
                data: 'url-actualiser',
                render: function (data, type, row, meta) {
                    if(type === 'display'){
                        let html = '<a href="' + row["url-actualiser"] + '" class="btn-actualiser m-1"><i class="fa-solid fa-arrows-rotate"></i></a>'
                        html += '<a href="' + row["url-supprimer"] + '" class="btn-supprimer m-1"><i class="fa-solid fa-trash"></i></a>'
                        return html;
                    }
                    return data;
                }
            }
        ]
    });
}

function initEvent(){
    datatable.on('click', '.btn-actualiser', eventActualiser);
    datatable.on('click', '.btn-supprimer', eventSupprimer);
    document.querySelector('[name="form_serie_add"]').addEventListener('submit', eventAdd);
}

function eventAdd(event){
    var data = this;
    fetch(data.getAttribute('action'), {
      method: data.getAttribute('method'),
      body: new FormData(data)
    }).then(res=>res.text())
      .then(function (data) {
          let modalAdd = Modal.getInstance("#modalAdd");
          modalAdd.hide();
          datatable.ajax.reload();
      });
    event.preventDefault();
}

function eventActualiser(event){
    event.preventDefault();
    let data = datatable.row(event.target.closest('tr')).data();

    var r = new XMLHttpRequest();
    r.open("GET", data["url-actualiser"], true);
    r.onreadystatechange = function () {
      if (r.readyState != 4 || r.status != 200) return;

      datatable.ajax.reload();
    };
    r.send();
}

function eventSupprimer(event){
    event.preventDefault();
    let data = datatable.row(event.target.closest('tr')).data();

    var r = new XMLHttpRequest();
    r.open("GET", data["url-supprimer"], true);
    r.onreadystatechange = function () {
      if (r.readyState != 4 || r.status != 200) return;

      datatable.ajax.reload();
    };
    r.send();
}