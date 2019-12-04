<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Point Of Sale</li>
        </ol>

        <div class="row">
      	<div class="col-lg-5 col-md-5">
      	<div class="row  card container">
        <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Expense Insert 
            <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal"  id="add_new"> Add Customer</a>
          </div>         
           
            <form>
            	<div class="card-body">
            	<table class="table table-striped">
				  <thead>
				    <tr>
				      <th scope="col">Name</th>
				      <th scope="col">QTY</th>
				      <th scope="col">Unit</th>
				      <th scope="col">Total</th>
				      <th scope="col">Action</th>
				   </tr>
				   </thead>
				  <tbody>
				    <tr>
				      <th>bus</th>
				      <td>2</td>
				      <td>423</td>
				      <td>2121</td>
				      <td>
				      	<a href="" class="btn btn-sm btn-danger">X</a>
				      </td>			      
				    </tr>				   
				  </tbody>
				</table>
				<hr>
               </div>            
               	 <div class="card-footer">
                      <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                         Total Quantity:
                          <strong>11</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                         Sub Total:
                          <strong>11111 Tk</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          Vat:
                         <strong>1%</strong>
                        </li>
                         <li class="list-group-item d-flex justify-content-between align-items-center">
                          Total:
                         <strong>1211 Tk</strong>
                        </li>
                      </ul>
                      <br>                  
                      <label>Customer Name</label>
                      <select class="form-control">
                         <option v-for="customer in customers">{{ customer.name }}</option>
                      </select>

                      <label>Pay</label>
                      <input type="" class="form-control">

                      <label>Due</label>
                      <input type="" class="form-control">

                      <label>Pay By </label>
                      <select class="form-control" v-model="">
                         <option>Hand Cash</option>
                         <option>Cheaque</option>
                         <option>Gift Card</option>
                      </select>
                      <br>
                      <button type="submit" class="btn btn-success">Submit</button>                                             		
               </div>
            </form>
        </div>
         
          <!-- customer modal-->
            </div>                             
           <div class="col-lg-7 col-md-7">
      		<div class="row  card container">
             <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Products             
          </div>
          <!--category wise product-->
          <div class="card-body"> 
         <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All product</a>
		  </li>
		  <li class="nav-item" v-for="category in categories" :key="category.id">
		    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" @click="subproduct(category.id)">{{category.category_name}}</a>
		  </li>
		  
		</ul>
		<div class="tab-content" id="pills-tabContent">


		  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		  	
           	 <input type="text"v-model="searchTerm" class="form-control" placeholder="search"><br>
            <div class="row">

               <div class="col-lg-3 col-md-3 col-sm-6" v-for= "product in filterSearch" :key="product.id">
               	<a href="">
               	<div class="card" style="width: 9rem; height: 120px">
				   <img :src="product.image" id="emp_photo" class="card-img-top" style="height: 100px; width: 100px;">
				  <div class="card-body">
				    <small class="card-title">{{product.product_name}}</small>	
				    <span v-if="product.product_quantity>=1"  class="badge badge-success">Available({{product.product_quantity}})</span> 
                    <span v-else="" class="badge badge-danger">Stock out</span> 			    
				  </div>
				</div>
				</a>
               </div>                             
            </div>
     
          
             <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"> 
                  <input type="text" v-model="getsearchTerm" class="form-control" placeholder="search"><br>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 col-sm-6 col-6" v-for="getproduct in getfiltersearch" :key="getproduct.id">
                       <button class="btn btn-sm" @click.prevent="AddToCart(getproduct.id)">
                        <div class="card" style="width: 9rem; height: 180px;">
                          <img :src="getproduct.image" class="card-img-top" style="height: 100px; width: 100px;">
                          <div class="card-body">
                            <small class="card-title">{{ getproduct.product_name }}</small>
                            <span class="badge badge-success" v-if="getproduct.product_quantity >= 1"> Availble ({{ getproduct.product_quantity }}) </span>
                           <span class="badge badge-danger" v-else="">Stock Out</span>
                             <!--<button class="badge badge-danger" v-else="" disabled="">Stock Out</button>-->
                          </div>
                        </div>
                        </button>
                      </div>
                    </div>
                 </div>
          
		  </div>
		  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>		  
		</div>
           
       </div>
      	</div>
      </div>
  </div>

        <!-- Icon Cards-->
       


   </div>
</template>



<script type="text/javascript">
	 export default {
	 	created(){
	 		if(!User.loggedIn()){
	 			this.$router.push({name : '/'})
	 		}
	 	},
    data(){

      return{ 
      form:{
      	       details:'',
                amount:'',
                name: '',
	 			email: '',
	 			address:'',
	 			phone:'',
	 			photo:'',
      },     
        products:[],
        searchTerm:'',
        getproducts:[],
        searchTerm:'',
       getsearchTerm:'',
        customers:'',
        errors:{},

      }
    },
    computed:{
      filterSearch(){
        return  this.products.filter(product => {
           return product.product_name.match(this.searchTerm)
         })
      },
      getfiltersearch(){
          return this.getproducts.filter(getproduct => {
             return getproduct.product_name.match(this.getsearchTerm)
           })
         },
    },
    methods:{
      allProduct(){
        axios.get('/api/product/')
        .then(({data}) =>(this.products = data))
        .catch()
      }, 
      allCategory(){
        axios.get('/api/category/')
        .then(({data}) =>(this.categories = data))
        .catch()
      },
      allCustomer(){
          axios.get('/api/customer/')
            .then(({data}) => (this.customers = data))
            .catch(console.log('error'))
        },
      subproduct(id)
        {
          axios.get('/api/getting/product/'+id)
            .then(({data}) => (this.getproducts = data))
            .catch(error => this.errors = error.response.data.errors)
        },     
    },
    created(){
      this.allProduct();
      this.allCategory();
      this.allCustomer();

    }
	
	
	}
</script>



<style type="text/css">
	#add_new{
	float: right;
}

</style>