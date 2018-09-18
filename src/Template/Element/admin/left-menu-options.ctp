<?php

    //print_r($loginuserdata);die;
    $controller = strtolower($this->request->params['controller']); 
    $action = strtolower($this->request->params['action']);  
    if($controller == 'users' && ($action == 'index')) {
        $dashboard_cls  = 'active';    
    }else{
        $dashboard_cls  = '';
    }


   
    if($controller == 'users' && ($action == 'add' || $action ==  'view' || $action == 'index')) {
        $deptype_cls  = 'active';
    }else{
        $deptype_cls  = '';
    }
?>  
<li class="<?php echo $dashboard_cls; ?>">   
    <a href="<?php echo $this->Url->build(['controller' => 'users', 'action' => 'dashboard']); ?>">
        <i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span>
    </a>
</li>

<li class = "<?php echo $deptype_cls; ?>">
    <a href="javascript:void(0)"><i class="fa fa-user"></i><span class="nav-label">Manage Users</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="<?php echo ($controller == 'users' && $action == 'index' || $action == 'view')?'active' :'' ?>" >
            <?php echo $this->Html->Link('Users List',array('controller' =>'users','action'=> 'index'),array('escape'=>false)); ?>                         
        </li>
         <li class="<?php echo ($controller == 'users' && $action == 'add')?'active' :'' ?>">
            <?php echo $this->Html->Link('Add User',array('controller' =>'users','action'=> 'add'),array('escape'=>false)); ?>                    
        </li >
    </ul>
</li>

<li class = "">
    <a href="javascript:void(0)"><i class="fa fa-sitemap"></i><span class="nav-label">Manage Roles</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="<?php echo ($controller == 'roles' && $action == 'index' || $action == 'view')?'active' :'' ?>" >
            <?php echo $this->Html->Link('User Roles',array('controller' =>'roles','action'=> 'index'),array('escape'=>false)); ?>                         
        </li>
         <li class="<?php echo ($controller == 'roles' && $action == 'add')?'active' :'' ?>">
            <?php echo $this->Html->Link('Add Role',array('controller' =>'roles','action'=> 'add'),array('escape'=>false)); ?>                    
        </li >
    </ul>
</li>

<li class = "">
    <a href="javascript:void(0)"><i class="fa fa-files-o"></i><span class="nav-label">Manage Pages</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="<?php echo ($controller == 'articles' && $action == 'index' || $action == 'view')?'active' :'' ?>" >
            <?php echo $this->Html->Link('Pages List',array('controller' =>'articles','action'=> 'index'),array('escape'=>false)); ?>                         
        </li>
         <li class="<?php echo ($controller == 'articles' && $action == 'add')?'active' :'' ?>">
            <?php echo $this->Html->Link('Add Page',array('controller' =>'articles','action'=> 'add'),array('escape'=>false)); ?>                    
        </li >
    </ul>
</li>

<li class = "">
    <a href="javascript:void(0)"><i class="fa fa-desktop"></i><span class="nav-label">Email Templates</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li class="<?php echo ($controller == 'emailTemplates' && $action == 'index' || $action == 'view')?'active' :'' ?>" >
            <?php echo $this->Html->Link('Templates List',array('controller' =>'emailTemplates','action'=> 'index'),array('escape'=>false)); ?>                         
        </li>
    </ul>
</li>