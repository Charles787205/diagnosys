const provinceSelect = document.getElementById('province');
const citySelect = document.getElementById('city');
const barangaySelect = document.getElementById('barangay');

const data = {

    'Davao del Norte': {
        'Your City':[],
        'Municipality of Asuncion': ['YourBarangay','Binancian', 'Buan', 'Buclad','Cabaywa', 'Camansa', 'Cambanogoy','Camoning','Canatan', 'Concepcion', 'Doña Andrea','Magatos', 'Napungas', 'New Bantayan','New Loon', 'New Santiago', 'Pamacaun','Sagayen','San Vicente', 'Santa Filomena', 'Sonlon'],
        'Municipality of Braulio E. Dujali': ['Your Barangay','Cabayangan', 'Dujali', 'Magupising', 'New Casay', 'Tanglaw'],
        'Municipality of Carmen': ['Your Barangay','Alejal', 'Anibongan', 'Asuncion','Cebulano', 'Guadalupe', 'Ising','La Paz','Mabaus', 'Mabuhay', 'Magsaysay','Mangalcal', 'Minda', 'New Camiling','Salvacion', 'San Isidro', 'Santo Niño','Taba','Tibulao', 'Tubod', 'Tuganay'],
        'Island Garden City of Samal': ['Your Barangay','Adecor', 'Anonang', 'Aumbay','Aundanao', 'Balet', 'Bandera','Caliclic (Dangca-an)','Camudmud', 'Catagman', 'Cawag','Cogon', 'Cogon (Talikud)', 'Dadatan','Del Monte', 'Guilon', 'Kanaan','Kinawitnon','Libertad', 'Libuak', 'Licup','Limao','Linosutan', 'Mambago-A', 'Mambago-B', 'Miranda (Poblacion)', 'Moncado (Poblacion)', 'Pangubatan','Peñaplata (Poblacion)', 'Poblacion (Kaputian)', 'San Agustin','San Antonio','San Isidro (Babak)', 'San Isidro (Kaputian)', 'San Jose (San Lapuz)','San Miguel (Magamomo)', 'San Remigio', 'Santa Cruz (Talicod II)','Santo Niño', 'Sion (Zion)', 'Tagbaobo','Tagbay','Tagbitan-ag', 'Tagdaliao', 'Tagpopongan','Tambo','Toril', 'Villarica' ],
        'Municipality of Kapalong': ['Your Barangay','Semong', 'Florida', 'Gabuyan','Gupitan', 'Capungagan', 'Katipunan','Luna','Mabantao', 'Mamacao', 'Pag-asa','Maniki (Poblacion)','Sampao', 'Sua-on', 'Tiburcia'],
        'Municipality of New Corella': ['Your Barangay','Cabidianan', 'Carcor', 'Del Monte','Del Pilar', 'El Salvador', 'Limba-an','Macgum', 'Mambing','Mesaoy', 'New Bohol', 'New Cortez','New Sambog', 'Patrocenio','Poblacion', 'San Roque','Santa Cruz', 'Santa Fe','San Roque','Santo Niño', 'Suawon','San Jose'],
        'City of Panabo': ['Your Barangay','A. O. Floirendo', 'Datu Abdul Dadia', 'Buenavista', 'Cacao','Cagangohan', 'Consolacion', 'Dapco','Gredu ','J.P. Laurel', 'Kasilak', 'Katipunan','Katualan', 'Kauswagan', 'Kiotoy','Little Panay', 'Lower Panaga', 'Mabunao','Maduao','Malativas', 'Manay', 'Nanyo','New Malaga (Dalisay)','New Malitbog', 'New Pandan', 'New Visayas','Quezon','Salvacion', 'San Francisco', 'San Nicolas','San Pedro','San Roque','San Vicente', 'Santa Cruz', 'Santo Niño','Sindaton','Southern Davao','Tagpore', 'Tibungol', 'Upper Licanan','Waterfall'],
        'Municipality of San Isidro': ['Your Barangay','Dacudao', 'Datu Balong', 'Igangon','Kipalili', 'Libuton', 'Linao','Mamangan','Monte Dujali', 'Pinamuno', 'Sabangan','San Miguel', 'Santo Niño', 'Sawata '],
        'Municipality of Sto. Tomas': ['Your Barangay','Balagunan', 'Bobongon', 'Casig-Ang','Esperanza', 'Kimamon', 'Kinamayan','La Libertad','Lungaog', 'Magwawa', 'New Katipunan','New Visayas', 'Pantaron', 'Salvacion','San Jose','San Miguel', 'San Vicente','Talomo','Tibal-og', 'Tulalian'],
        'City of Tagum': ['Your Barangay','Apokon', 'Bincungan', 'Busaon','Canocotan', 'Cuambogan', 'La Filipina','Liboganon','Madaum', 'Magdum', 'Magugpo Poblacion','Magugpo East','Magugpo North','Magugpo South', 'Magugpo West', 'Mankilam','New Balamban','Nueva Fuerza', 'Pagsabangan', 'Pandapan','San Agustin','San Isidro', 'San Miguel ', 'Visayan Village'],
        'Municipality of Talaingod': ['Your Barangay','Dagohoy', 'Palma Gil', 'Santo Niño'],
    },
   
   
    // Add more provinces, cities, and barangays here
};

// Populate province options
for (const province in data) {
    const option = document.createElement('option');
    option.value = province;
    option.textContent = province;
    provinceSelect.appendChild(option);
}

// Update city options based on selected province
provinceSelect.addEventListener('change', function () {
    const selectedProvince = this.value;
    citySelect.innerHTML = '';
    barangaySelect.innerHTML = '';
    
    if (selectedProvince !== '') {
        const cities = data[selectedProvince];
        
        for (const city in cities) {
            const option = document.createElement('option');
            option.value = city;
            option.textContent = city;
            citySelect.appendChild(option);
        }
    }
});

// Update barangay options based on selected city
citySelect.addEventListener('change', function () {
    const selectedProvince = provinceSelect.value;
    const selectedCity = this.value;
    barangaySelect.innerHTML = '';
    
    if (selectedProvince !== '' && selectedCity !== '') {
        const barangays = data[selectedProvince][selectedCity];
        
        for (const barangay of barangays) {
            const option = document.createElement('option');
            option.value = barangay;
            option.textContent = barangay;
            barangaySelect.appendChild(option);
        }
    }
});


// ... Previous JavaScript code ...

// Function to save user selection
function saveUserSelection(province, city, barangay) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_selection.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Log the server response
        }
    };

    const data = `province=${province}&city=${city}&barangay=${barangay}`;
    xhr.send(data);
}

// Event listener for the "Save" button
const saveButton = document.getElementById('saveButton');
saveButton.addEventListener('click', function () {
    const selectedProvince = provinceSelect.value;
    const selectedCity = citySelect.value;
    const selectedBarangay = barangaySelect.value;

    saveUserSelection(selectedProvince, selectedCity, selectedBarangay);
});
