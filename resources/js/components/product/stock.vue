<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employee</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row  card container">
        <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Employee Insert 
            <router-link to="/store-supplier" class="btn btn-sm btn-info" id="add_new">Add New</router-link>
          </div>
           <div class="card-body">
           <div class="card-body">
            <div class="table-responsive">
              <label>Search</label>
              <input type="text" v-model="searchTerm" class="form-control" style="width:200px;">
              <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>                    
                    <th>Photo</th>
                    <th>product_code</th>                    
                    <th>buying_price</th>
                    <th>status</th> 
                    <th>category</th> 
                    <th>quantity</th>                  
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
                  <tr v-for= "product in filterSearch" :key="product.id">
                    <td>{{product.product_name}}</td>
                    <td><img :src="product.image" id="emp_photo"></td>
                    <td>{{product.product_code}}</td>                  
                    <td>{{product.buying_price}}</td>
                    <td v-if="product.product_quantity>=1"><span class="badge badge-success">Available</span></td> 
                    <td v-else=""><span class="badge badge-danger">Stock out</span></td> 
                    <td>{{product.category_name}}</td> 
                    <td>{{product.product_quantity}}</td>                  
                     <td>                      
                       <router-link :to="{ name: 'edit-stock', params:{id:product.id} }" class="btn btn-sm btn-info">Edit</router-link>
                        
                     </td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
          </div>
          </div>
       </div>
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
        products:[],
        searchTerm:'',
      }
    },
    computed:{
      filterSearch(){
        return  this.products.filter(product => {
           return product.product_name.match(this.searchTerm)
         })
      }
    },
    methods:{
      allProduct(){
        axios.get('/api/product/')
        .then(({data}) =>(this.products = data))
        .catch()
      },
      
    },
    created(){
      this.allProduct();
    }
	
	
	}
</script>



<style type="text/css">
	#add_new{
	float: right;
}
#emp_photo{
   height: 40px;
   width: 30px;
}
</style>