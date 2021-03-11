let ipVisitante, paisVisitante, provinciaVisitante

let visitantesInicial = async ()=> 
{
    const url = 'Visitantes/geolocaliza.php'
	const request = new Request(url, 
	{
		method: 'POST',
		//body: JSON.stringify({"ip": ip.innerHTML, "organismo": organismo.innerHTML, "usuario": nombre.innerHTML}),
		cache: "no-cache",
	   headers: new Headers({"content-type": "application/json"})
	});
	const response = await fetch(request);
	const data = await response.json();
	//console.log(data)
    ipVisitante = data.ip
	paisVisitante = data.pais
	provinciaVisitante = data.provincia
	console.log("IP: " +ipVisitante + "/// Pais: " +paisVisitante+ "/// Provincia: " +provinciaVisitante)
	
	agregaVisitante(ipVisitante, paisVisitante, provinciaVisitante)
}

let agregaVisitante = async(ip, pais, provincia)=>
{
	const url = 'Visitantes/visitantes-verifica-o-inserta.php'
	const request = new Request(url, 
	{
		method: 'POST',
		body: JSON.stringify({"ip": ip, "pais": pais, "provincia": provincia}),
		cache: "no-cache",
	   	headers: new Headers({"content-type": "application/json"})
	});
	const response = await fetch(request);
	const data = await response.json();
	console.log ("el resultado es: " +data.resultado)
	//console.log(data)

}

	
window.onload = visitantesInicial();