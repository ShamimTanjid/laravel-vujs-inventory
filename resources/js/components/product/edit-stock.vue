<template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Product</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row  container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Product Insert 
            
          </div>
          <div class="card-body">
          	  <form @submit.prevent="stockUpdate">               	          
	          <div class="form-group">
	              <div class="form-row">	               	               
	               <div class="col-md-12">
	                <div class="form-label-group">
	                  <input type="text" v-model="form.product_quantity" class="form-control"  required="">
	                  <label for="phone">product_quantity</label>
	                  <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
	                </div>
	               </div>
	             </div>
	          </div>             
               <button type="submit" class="btn btn-success">Submit</button>
              </form>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
	 	created(){
            let id = this.$route.params.id
		 	axios.get('/api/product/'+id)
		 	.then(({data}) => (this.form = data))
		 	.catch()	 		
	 	},
	 data(){
	 	return {
	 		form:{	 			
	 			product_quantity:'',

	 			
	 		},
	 		errors:{},	 		

	 		
	 	}
	 },
	 methods:{ 		 	
	 	stockUpdate(){
	 		let id = this.$route.params.id
        		axios.post('/api/stock/update/'+id,this.form)
        		.then( ()=>{
        			this.$router.push({ name:'stock'})
        			Notification.success()
        		})
        		.catch(error => this.errors = error.response.data.errors)
        	},
	 }
	
	}
</script>



<style type="text/css">
	#add_new{
	float: right;
}
</style>