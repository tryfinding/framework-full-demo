<?php 
use app\models\menu as Menu;

$datas = Menu::tableTree($datas);
$this->layout('default');

$this->start('content');
 
$par = ['s'=>$_GET['s']];

?>

<div class="container">
     <h1>分类</h1>
     <?php if($list==1){?>
     	<form class='ajax_form' method='post' action="<?php echo url('post/type/sort');?>">
     <table class="table">
      <caption>管理分类(<?php echo $count;?>). 
      	<span class='pull-right'>
      		<a href="<?php echo url('post/type/view');?>" class="button">
	          添加
	        </a>
	        
	      </span>
	  </caption>
      <thead>
        <tr>
          <th>标识</th>
          <th>标题</th>
          <th>时间</th>
          <th></th>
        </tr>
      </thead>
      <tbody id='sortable'>
      <?php if($datas){foreach($datas as $data){ if(!$data){ continue;}?>
        <tr>
          <td>
          	<input type="hidden" name="t[]" value="<?php echo (string)$data['_id'];?>">
          <?php echo $data['slug'];?></td>
          <td><?php echo strip_tags($data['title']);?></td>
          <td><?php echo date('Y-m-d H',$data['created']->sec);?></td>
          <td class='pull-right'>
          
          	<a href="<?php echo url('post/type/status',['id'=>(string)$data['_id']]+$par);?>" class="button">
	         	<?php 
	         		switch ($data['status']){
	         			case 1:
	         				echo '<span class="fa fa-check"></span>';
	         				break;
	         			default:
	         				echo '<span class="fa fa-close" style="color:red;"></span>';
	         				break;
	         		}
	         	?> 
	        </a>
	        
	        
          	<a href="<?php echo url('post/type/view',['id'=>(string)$data['_id']]);?>" class="fa fa-pencil">
	          
	        </a>
	        
	        <a href="<?php echo url('post/type/remove',['id'=>(string)$data['_id']]);?>" class="remove fa fa-remove">
	          
	        </a>
	        
	        
          </td>
        </tr>
       <?php }}?> 
      </tbody>
    </table>
    <button type="submit" class="btn btn-success">保存</button>
    </form>
    <?php echo $page;?>
    <?php }?>
    
   <?php if($view==1){?>
   	  <?php if($error){
		    		 
		    			echo '<div class="alert alert-dismissible alert-danger">'.$error.'</div>';
		    		
		    } ?>
     <form method="POST" class='ajax_form'  enctype="multipart/form-data">
	  <div class="form-group">
	    <label >分类名</label>
	    <input type="input" class="form-control"  value="<?php echo $data['title'];?>" name='title' >
	    <div class='alert alert-warning error' style="display:none;"></div>
	  </div>
	  <div class="form-group">
	    <label >唯一标识</label>
	    <input type="input" class="form-control"  value="<?php echo $data['slug'];?>" name='slug' >
	    <div class='alert alert-warning error' style="display:none;"></div>
	  </div>
	  <?php if($category){?>
	  <div class="form-group">
	    <label >上一层分类</label>
		<p>
		    <select name='pid' class="select form-control">
		    	<?php echo $category;?>
		    </select>
	    </p>
	  </div>
	  <?php }?>
	  <br style="clear:both;">
	  <div class="form-group">
	    <label>状态</label>
	    
	    <?php $status = [
	    	1=>'启用',
	    	0=>'禁用',
	    ];?>
	    <p>
	    <select name="status" class="select">
	    <?php 
	    $true = false;
	    foreach($status as $k=>$v){?>
	    	<option value=<?php echo $k;?> <?php if($true===false && ($data['status']==$k || !$_GET['id']) ) { $true = true;?>selected<?php }?> >
	    		<?php echo $v;?>
	    	</option>
	    <?php }?>
	    </select>
	    </p>
	  </div>
	   
	  <button type="submit" id='submit' class="btn btn-success">保存</button>
	</form>
<?php }?>



</div>
     

<?php 

$this->end();
?>



 
