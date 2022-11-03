const btnAll = document.querySelector('.btn-all');
const btnBreads = document.querySelector('.btn-breads');
const btnCakes = document.querySelector('.btn-cakes');
const btnDonuts = document.querySelector('.btn-donuts');
const btnCookies = document.querySelector('.btn-cookies');

const $breads =document.querySelectorAll('.product_cat-breads');
console.log($breads);
const $cakes =document.querySelectorAll('.product_cat-cakes');
const $donuts =document.querySelectorAll('.product_cat-donuts');
const $cookies =document.querySelectorAll('.product_cat-cookies');

// const $breads =userList.querySelectorAll('.product_cat-breads');
// const $cakes =userList.querySelectorAll('.product_cat-cakes');
// const $donuts =userList.querySelectorAll('.product_cat-donuts');
// const $cookies =userList.querySelectorAll('.product_cat-cookies');


btnBreads.addEventListener('click',()=>{
  $donuts.forEach(donut => { donut.style.display = 'none';});
  $cookies.forEach(cookie => { cookie.style.display = 'none';});
  $cakes.forEach(cake => { cake.style.display = 'none';});
  $breads.forEach(bread => { bread.style.display = 'block';});
});
btnDonuts.addEventListener('click',()=>{
  $donuts.forEach(donut => { donut.style.display = 'block';});
  $cookies.forEach(cookie => { cookie.style.display = 'none';});
  $cakes.forEach(cake => { cake.style.display = 'none';});
  $breads.forEach(bread => { bread.style.display = 'none';});
});
btnCakes.addEventListener('click',()=>{
  $donuts.forEach(donut => { donut.style.display = 'none';});
  $cookies.forEach(cookie => { cookie.style.display = 'none';});
  $cakes.forEach(cake => { cake.style.display = 'block';});
  $breads.forEach(bread => { bread.style.display = 'none';});
});
btnCookies.addEventListener('click',()=>{
  $donuts.forEach(donut => { donut.style.display = 'none';});
  $cookies.forEach(cookie => { cookie.style.display = 'block';});
  $cakes.forEach(cake => { cake.style.display = 'none';});
  $breads.forEach(bread => { bread.style.display = 'none';});
});
btnAll.addEventListener('click',()=>{
  $donuts.forEach(donut => { donut.style.display = 'block';});
  $cookies.forEach(cookie => { cookie.style.display = 'block';});
  $cakes.forEach(cake => { cake.style.display = 'block';});
  $breads.forEach(bread => { bread.style.display = 'block';});
});






