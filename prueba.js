{   
    ${data.body.numeroRuc}
    "numeroRuc": "20100047218",

    "datosContribuyente": {
        ${data.body.datosContribuyente.codDomHabido}
        "codDomHabido": "HABIDO",
        "contacto": {
            ${data.body.datosContribuyente.contacto.numTelefono1}
            "numTelefono1": "3132122",
            ${data.body.datosContribuyente.contacto.numTelefono2}
            "numTelefono2": "3132000",
            ${data.body.datosContribuyente.contacto.numTelefono3}
            "numTelefono3": "999658578"
        },
        ${data.body.datosContribuyente.desRazonSocial}
        "desRazonSocial": "BANCO DE CREDITO DEL PERU",
        "ubigeo": {
            ${data.body.datosContribuyente.ubigeo.codUbigeo}
            "codUbigeo": "150114",
            ${data.body.datosContribuyente.ubigeo.desDistrito}
            "desDistrito": "LA MOLINA",
            ${data.body.datosContribuyente.ubigeo.desProvincia}
            "desProvincia": "LIMA",
            ${data.body.datosContribuyente.ubigeo.desDepartamento}
            "desDepartamento": "LIMA"
        },
        ${data.body.datosContribuyente.desDireccion}
        "desDireccion": "CAL. CENTENARIO NRO. 156      LAS LADERAS DE MELGAREJO",
        ${data.body.datosContribuyente.desNomApe}
        "desNomApe": "BANCO DE CREDITO DEL PERU",
        ${data.body.datosContribuyente.codCorreo2}
        "codCorreo2": "jmunoz@bcp.com.pe",
        ${data.body.datosContribuyente.codCorreo1}
        "codCorreo1": "vchang@bcp.com.pe",
        ${data.body.datosContribuyente.codEstado}
        "codEstado": "ACTIVO"
    },
    ${data.body.nombreComercial}
    "nombreComercial": "BANCO DE CREDITO DEL PERU",

    "actividadEconomica": [
        ${data.body.actividadEconomica.0}
        "Principal - CIIU 65197 - OTROS TIPOS INTERMEDIACION MONETARIA.",
        ${data.body.actividadEconomica.1}
        "Secundaria 1 - CIIU 65912 - ARRENDAMIENTO CON OPCION DE COMPRA"
    ],
    "sistemaEmisionElectronica": [
        ${data.body.sistemaEmisionElectronica.0}
        "FACTURA PORTAL DESDE 26/11/2014",
        ${data.body.sistemaEmisionElectronica.1}
        "DESDE LOS SISTEMAS DEL CONTRIBUYENTE. AUTORIZ DESDE 30/01/2018",
        ${data.body.sistemaEmisionElectronica.2}
        "SEE-FACTURADOR . AUTORIZ DESDE 09/11/2017"
    ],
    "padrones": [
        ${data.body.padrones.0}
        "Incorporado al Régimen de Agentes de Retención de IGV (R.S.037-2002) a partir del 01/06/2002"
    ]
}

resultadosDiv.innerHTML = `<p>Estado: ${data.statusCode}</p>`;
resultadosDiv.innerHTML += `<p>RUC: ${data.body.numeroRuc}</p>`;
resultadosDiv.innerHTML += `<p>Razón Social: ${data.body.datosContribuyente.desRazonSocial}</p>`;