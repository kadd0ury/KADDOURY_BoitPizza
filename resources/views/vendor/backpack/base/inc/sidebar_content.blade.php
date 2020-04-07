<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="fa fa-cogs"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('catproduit') }}'><i class="fa fa-th-list"></i> Catégories</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('produit') }}'><i class="fa fa-rub"></i> Produits</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('client') }}'><i class="fa fa-users" aria-hidden="true"></i> Clients</a></li>