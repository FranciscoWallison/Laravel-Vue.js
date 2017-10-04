const verssao = 1

//criar uma avriavel global para poder atualizar o css
let arquivos = [
"/",
"css/spa.css.map",
"css/spa.css",
"js/app.js",
]

self.addEventListener("install", function(){
	console.log("Instalou");	
})

self.addEventListener("activate", function(){
	caches.open("ceep-arquivos-" + verssao ).then(cache => {
		cache.addAll(arquivos).then(cache => {
			caches.delete("ceep-arquivos-"+ ( verssao - 1 ) )
			caches.delete("ceep-arquivos")
		})
	})
})

caches.open('ceep-arquivos').then(cache =>{
	cache.addAll(arquivos);
})

self.addEventListener('fetch', function(event){

	let pedido = event.request
	let promiseResposta = caches.match(pedido).then(respostaCache => {
		let resposta = respostaCache ? respostaCache : fetch(pedido)
		return resposta
	})

	event.respondWith(promiseResposta)
})