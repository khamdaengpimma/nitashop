
function product_load(){
    var product=document.getElementById("product")
    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
      };
      fetch("http://localhost/nitaya/db/products/read.php", requestOptions)
        .then(response => response.text())
        .then(result => {
            let allpd  =JSON.parse(result)
            for(pd of allpd){
                var html=`<div class="product-card">
                <img src=${pd.images}>
                <h3>${pd.nameproduct}</h3>
                <p class="price">$${pd.price}</p>
                <button class="add-to-cart">Add to Cart</button>
                <button class="buy-now">Buy Now</button>
              </div>`;
            product.insertAdjacentHTML('beforeend',html);
            }
        })
        .catch(error => console.log('error', error));
    }