function recommendProducts(productId){
    let product = products.find(p => p.id === productId);
    let related = products.filter(p => p.category === product.category && p.id !== productId);
    
    console.log("AI Recommended:", related);
}