<?php
// @link https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata
namespace PHPSTORM_META {

	override(
		\Cake\ORM\TableRegistry::get(0),
		map([
			'Colours' => \App\Model\Table\ColoursTable::class,
			'ConnectedPhones' => \App\Model\Table\ConnectedPhonesTable::class,
			'Customers' => \App\Model\Table\CustomersTable::class,
			'ItemReturns' => \App\Model\Table\ItemReturnsTable::class,
			'Manufacturers' => \App\Model\Table\ManufacturersTable::class,
			'ModelColours' => \App\Model\Table\ModelColoursTable::class,
			'ModelStorages' => \App\Model\Table\ModelStoragesTable::class,
			'Models' => \App\Model\Table\ModelsTable::class,
			'Phones' => \App\Model\Table\PhonesTable::class,
			'Repairs' => \App\Model\Table\RepairsTable::class,
			'Returns' => \App\Model\Table\ReturnsTable::class,
			'Storages' => \App\Model\Table\StoragesTable::class,
			'SupplierOrders' => \App\Model\Table\SupplierOrdersTable::class,
			'Suppliers' => \App\Model\Table\SuppliersTable::class,
			'Transactions' => \App\Model\Table\TransactionsTable::class,
			'Users' => \App\Model\Table\UsersTable::class,
			'DebugKit.Panels' => \DebugKit\Model\Table\PanelsTable::class,
			'DebugKit.Requests' => \DebugKit\Model\Table\RequestsTable::class,
		])
	);

	override(
		\Cake\ORM\Locator\LocatorInterface::get(0),
		map([
			'Colours' => \App\Model\Table\ColoursTable::class,
			'ConnectedPhones' => \App\Model\Table\ConnectedPhonesTable::class,
			'Customers' => \App\Model\Table\CustomersTable::class,
			'ItemReturns' => \App\Model\Table\ItemReturnsTable::class,
			'Manufacturers' => \App\Model\Table\ManufacturersTable::class,
			'ModelColours' => \App\Model\Table\ModelColoursTable::class,
			'ModelStorages' => \App\Model\Table\ModelStoragesTable::class,
			'Models' => \App\Model\Table\ModelsTable::class,
			'Phones' => \App\Model\Table\PhonesTable::class,
			'Repairs' => \App\Model\Table\RepairsTable::class,
			'Returns' => \App\Model\Table\ReturnsTable::class,
			'Storages' => \App\Model\Table\StoragesTable::class,
			'SupplierOrders' => \App\Model\Table\SupplierOrdersTable::class,
			'Suppliers' => \App\Model\Table\SuppliersTable::class,
			'Transactions' => \App\Model\Table\TransactionsTable::class,
			'Users' => \App\Model\Table\UsersTable::class,
			'DebugKit.Panels' => \DebugKit\Model\Table\PanelsTable::class,
			'DebugKit.Requests' => \DebugKit\Model\Table\RequestsTable::class,
		])
	);

	override(
		\Cake\Datasource\ModelAwareTrait::loadModel(0),
		map([
			'Colours' => \App\Model\Table\ColoursTable::class,
			'ConnectedPhones' => \App\Model\Table\ConnectedPhonesTable::class,
			'Customers' => \App\Model\Table\CustomersTable::class,
			'ItemReturns' => \App\Model\Table\ItemReturnsTable::class,
			'Manufacturers' => \App\Model\Table\ManufacturersTable::class,
			'ModelColours' => \App\Model\Table\ModelColoursTable::class,
			'ModelStorages' => \App\Model\Table\ModelStoragesTable::class,
			'Models' => \App\Model\Table\ModelsTable::class,
			'Phones' => \App\Model\Table\PhonesTable::class,
			'Repairs' => \App\Model\Table\RepairsTable::class,
			'Returns' => \App\Model\Table\ReturnsTable::class,
			'Storages' => \App\Model\Table\StoragesTable::class,
			'SupplierOrders' => \App\Model\Table\SupplierOrdersTable::class,
			'Suppliers' => \App\Model\Table\SuppliersTable::class,
			'Transactions' => \App\Model\Table\TransactionsTable::class,
			'Users' => \App\Model\Table\UsersTable::class,
			'DebugKit.Panels' => \DebugKit\Model\Table\PanelsTable::class,
			'DebugKit.Requests' => \DebugKit\Model\Table\RequestsTable::class,
		])
	);

	override(
		\ModelAwareTrait::loadModel(0),
		map([
			'Colours' => \App\Model\Table\ColoursTable::class,
			'ConnectedPhones' => \App\Model\Table\ConnectedPhonesTable::class,
			'Customers' => \App\Model\Table\CustomersTable::class,
			'ItemReturns' => \App\Model\Table\ItemReturnsTable::class,
			'Manufacturers' => \App\Model\Table\ManufacturersTable::class,
			'ModelColours' => \App\Model\Table\ModelColoursTable::class,
			'ModelStorages' => \App\Model\Table\ModelStoragesTable::class,
			'Models' => \App\Model\Table\ModelsTable::class,
			'Phones' => \App\Model\Table\PhonesTable::class,
			'Repairs' => \App\Model\Table\RepairsTable::class,
			'Returns' => \App\Model\Table\ReturnsTable::class,
			'Storages' => \App\Model\Table\StoragesTable::class,
			'SupplierOrders' => \App\Model\Table\SupplierOrdersTable::class,
			'Suppliers' => \App\Model\Table\SuppliersTable::class,
			'Transactions' => \App\Model\Table\TransactionsTable::class,
			'Users' => \App\Model\Table\UsersTable::class,
			'DebugKit.Panels' => \DebugKit\Model\Table\PanelsTable::class,
			'DebugKit.Requests' => \DebugKit\Model\Table\RequestsTable::class,
		])
	);

	override(
		\Cake\ORM\Table::addBehavior(0),
		map([
			'CounterCache' => \Cake\ORM\Table::class,
			'Timestamp' => \Cake\ORM\Table::class,
			'Translate' => \Cake\ORM\Table::class,
			'Tree' => \Cake\ORM\Table::class,
			'DebugKit.Timed' => \Cake\ORM\Table::class,
			'Search.Search' => \Cake\ORM\Table::class,
		])
	);

	override(
		\Cake\Controller\Controller::loadComponent(0),
		map([
			'Auth' => \Cake\Controller\Component\AuthComponent::class,
			'Cookie' => \Cake\Controller\Component\CookieComponent::class,
			'Csrf' => \Cake\Controller\Component\CsrfComponent::class,
			'Flash' => \Cake\Controller\Component\FlashComponent::class,
			'Paginator' => \Cake\Controller\Component\PaginatorComponent::class,
			'RequestHandler' => \Cake\Controller\Component\RequestHandlerComponent::class,
			'Security' => \Cake\Controller\Component\SecurityComponent::class,
			'Modal' => \App\Controller\Component\ModalComponent::class,
			'DebugKit.Toolbar' => \DebugKit\Controller\Component\ToolbarComponent::class,
			'Search.Prg' => \Search\Controller\Component\PrgComponent::class,
		])
	);

	override(
		\Cake\View\View::loadHelper(0),
		map([
			'Breadcrumbs' => \Cake\View\Helper\BreadcrumbsHelper::class,
			'Flash' => \Cake\View\Helper\FlashHelper::class,
			'Form' => \Cake\View\Helper\FormHelper::class,
			'Html' => \Cake\View\Helper\HtmlHelper::class,
			'Number' => \Cake\View\Helper\NumberHelper::class,
			'Paginator' => \Cake\View\Helper\PaginatorHelper::class,
			'Rss' => \Cake\View\Helper\RssHelper::class,
			'Session' => \Cake\View\Helper\SessionHelper::class,
			'Text' => \Cake\View\Helper\TextHelper::class,
			'Time' => \Cake\View\Helper\TimeHelper::class,
			'Url' => \Cake\View\Helper\UrlHelper::class,
			'Bake.Bake' => \Bake\View\Helper\BakeHelper::class,
			'Bake.DocBlock' => \Bake\View\Helper\DocBlockHelper::class,
			'Bootstrap.BootstrapBreadcrumbs' => \Bootstrap\View\Helper\BootstrapBreadcrumbsHelper::class,
			'Bootstrap.BootstrapFlash' => \Bootstrap\View\Helper\BootstrapFlashHelper::class,
			'Bootstrap.BootstrapForm' => \Bootstrap\View\Helper\BootstrapFormHelper::class,
			'Bootstrap.BootstrapHtml' => \Bootstrap\View\Helper\BootstrapHtmlHelper::class,
			'Bootstrap.BootstrapModal' => \Bootstrap\View\Helper\BootstrapModalHelper::class,
			'Bootstrap.BootstrapNavbar' => \Bootstrap\View\Helper\BootstrapNavbarHelper::class,
			'Bootstrap.BootstrapPaginator' => \Bootstrap\View\Helper\BootstrapPaginatorHelper::class,
			'Bootstrap.BootstrapPanel' => \Bootstrap\View\Helper\BootstrapPanelHelper::class,
			'Bootstrap.Breadcrumbs' => \Bootstrap\View\Helper\BreadcrumbsHelper::class,
			'Bootstrap.Flash' => \Bootstrap\View\Helper\FlashHelper::class,
			'Bootstrap.Form' => \Bootstrap\View\Helper\FormHelper::class,
			'Bootstrap.Html' => \Bootstrap\View\Helper\HtmlHelper::class,
			'Bootstrap.Modal' => \Bootstrap\View\Helper\ModalHelper::class,
			'Bootstrap.Navbar' => \Bootstrap\View\Helper\NavbarHelper::class,
			'Bootstrap.Paginator' => \Bootstrap\View\Helper\PaginatorHelper::class,
			'Bootstrap.Panel' => \Bootstrap\View\Helper\PanelHelper::class,
			'DebugKit.Credentials' => \DebugKit\View\Helper\CredentialsHelper::class,
			'DebugKit.SimpleGraph' => \DebugKit\View\Helper\SimpleGraphHelper::class,
			'DebugKit.Tidy' => \DebugKit\View\Helper\TidyHelper::class,
			'DebugKit.Toolbar' => \DebugKit\View\Helper\ToolbarHelper::class,
			'Migrations.Migration' => \Migrations\View\Helper\MigrationHelper::class,
		])
	);

	override(
		\Cake\ORM\Table::belongsTo(0),
		map([
			'Colours' => \Cake\ORM\Association\BelongsTo::class,
			'ConnectedPhones' => \Cake\ORM\Association\BelongsTo::class,
			'Customers' => \Cake\ORM\Association\BelongsTo::class,
			'ItemReturns' => \Cake\ORM\Association\BelongsTo::class,
			'Manufacturers' => \Cake\ORM\Association\BelongsTo::class,
			'ModelColours' => \Cake\ORM\Association\BelongsTo::class,
			'ModelStorages' => \Cake\ORM\Association\BelongsTo::class,
			'Models' => \Cake\ORM\Association\BelongsTo::class,
			'Phones' => \Cake\ORM\Association\BelongsTo::class,
			'Repairs' => \Cake\ORM\Association\BelongsTo::class,
			'Returns' => \Cake\ORM\Association\BelongsTo::class,
			'Storages' => \Cake\ORM\Association\BelongsTo::class,
			'SupplierOrders' => \Cake\ORM\Association\BelongsTo::class,
			'Suppliers' => \Cake\ORM\Association\BelongsTo::class,
			'Transactions' => \Cake\ORM\Association\BelongsTo::class,
			'Users' => \Cake\ORM\Association\BelongsTo::class,
			'DebugKit.Panels' => \Cake\ORM\Association\BelongsTo::class,
			'DebugKit.Requests' => \Cake\ORM\Association\BelongsTo::class,
		])
	);

	override(
		\Cake\ORM\Table::hasOne(0),
		map([
			'Colours' => \Cake\ORM\Association\HasOne::class,
			'ConnectedPhones' => \Cake\ORM\Association\HasOne::class,
			'Customers' => \Cake\ORM\Association\HasOne::class,
			'ItemReturns' => \Cake\ORM\Association\HasOne::class,
			'Manufacturers' => \Cake\ORM\Association\HasOne::class,
			'ModelColours' => \Cake\ORM\Association\HasOne::class,
			'ModelStorages' => \Cake\ORM\Association\HasOne::class,
			'Models' => \Cake\ORM\Association\HasOne::class,
			'Phones' => \Cake\ORM\Association\HasOne::class,
			'Repairs' => \Cake\ORM\Association\HasOne::class,
			'Returns' => \Cake\ORM\Association\HasOne::class,
			'Storages' => \Cake\ORM\Association\HasOne::class,
			'SupplierOrders' => \Cake\ORM\Association\HasOne::class,
			'Suppliers' => \Cake\ORM\Association\HasOne::class,
			'Transactions' => \Cake\ORM\Association\HasOne::class,
			'Users' => \Cake\ORM\Association\HasOne::class,
			'DebugKit.Panels' => \Cake\ORM\Association\HasOne::class,
			'DebugKit.Requests' => \Cake\ORM\Association\HasOne::class,
		])
	);

	override(
		\Cake\ORM\Table::hasMany(0),
		map([
			'Colours' => \Cake\ORM\Association\HasMany::class,
			'ConnectedPhones' => \Cake\ORM\Association\HasMany::class,
			'Customers' => \Cake\ORM\Association\HasMany::class,
			'ItemReturns' => \Cake\ORM\Association\HasMany::class,
			'Manufacturers' => \Cake\ORM\Association\HasMany::class,
			'ModelColours' => \Cake\ORM\Association\HasMany::class,
			'ModelStorages' => \Cake\ORM\Association\HasMany::class,
			'Models' => \Cake\ORM\Association\HasMany::class,
			'Phones' => \Cake\ORM\Association\HasMany::class,
			'Repairs' => \Cake\ORM\Association\HasMany::class,
			'Returns' => \Cake\ORM\Association\HasMany::class,
			'Storages' => \Cake\ORM\Association\HasMany::class,
			'SupplierOrders' => \Cake\ORM\Association\HasMany::class,
			'Suppliers' => \Cake\ORM\Association\HasMany::class,
			'Transactions' => \Cake\ORM\Association\HasMany::class,
			'Users' => \Cake\ORM\Association\HasMany::class,
			'DebugKit.Panels' => \Cake\ORM\Association\HasMany::class,
			'DebugKit.Requests' => \Cake\ORM\Association\HasMany::class,
		])
	);

	override(
		\Cake\ORM\Table::belongToMany(0),
		map([
			'Colours' => \Cake\ORM\Association\BelongsToMany::class,
			'ConnectedPhones' => \Cake\ORM\Association\BelongsToMany::class,
			'Customers' => \Cake\ORM\Association\BelongsToMany::class,
			'ItemReturns' => \Cake\ORM\Association\BelongsToMany::class,
			'Manufacturers' => \Cake\ORM\Association\BelongsToMany::class,
			'ModelColours' => \Cake\ORM\Association\BelongsToMany::class,
			'ModelStorages' => \Cake\ORM\Association\BelongsToMany::class,
			'Models' => \Cake\ORM\Association\BelongsToMany::class,
			'Phones' => \Cake\ORM\Association\BelongsToMany::class,
			'Repairs' => \Cake\ORM\Association\BelongsToMany::class,
			'Returns' => \Cake\ORM\Association\BelongsToMany::class,
			'Storages' => \Cake\ORM\Association\BelongsToMany::class,
			'SupplierOrders' => \Cake\ORM\Association\BelongsToMany::class,
			'Suppliers' => \Cake\ORM\Association\BelongsToMany::class,
			'Transactions' => \Cake\ORM\Association\BelongsToMany::class,
			'Users' => \Cake\ORM\Association\BelongsToMany::class,
			'DebugKit.Panels' => \Cake\ORM\Association\BelongsToMany::class,
			'DebugKit.Requests' => \Cake\ORM\Association\BelongsToMany::class,
		])
	);

	override(
		\Cake\ORM\Table::find(0),
		map([
			'all' => \Cake\ORM\Query::class,
			'list' => \Cake\ORM\Query::class,
			'threaded' => \Cake\ORM\Query::class,
		])
	);

	override(
		\Cake\ORM\Association::find(0),
		map([
			'all' => \Cake\ORM\Query::class,
			'list' => \Cake\ORM\Query::class,
			'threaded' => \Cake\ORM\Query::class,
		])
	);

	override(
		\Cake\Datasource\QueryInterface::find(0),
		map([
			'all' => \Cake\ORM\Query::class,
			'list' => \Cake\ORM\Query::class,
			'threaded' => \Cake\ORM\Query::class,
		])
	);

	override(
		\Cake\Database\Type::build(0),
		map([
			'tinyinteger' => \Cake\Database\Type\IntegerType::class,
			'smallinteger' => \Cake\Database\Type\IntegerType::class,
			'integer' => \Cake\Database\Type\IntegerType::class,
			'biginteger' => \Cake\Database\Type\IntegerType::class,
			'binary' => \Cake\Database\Type\BinaryType::class,
			'boolean' => \Cake\Database\Type\BoolType::class,
			'date' => \Cake\Database\Type\DateType::class,
			'datetime' => \Cake\Database\Type\DateTimeType::class,
			'decimal' => \Cake\Database\Type\DecimalType::class,
			'float' => \Cake\Database\Type\FloatType::class,
			'json' => \Cake\Database\Type\JsonType::class,
			'string' => \Cake\Database\Type\StringType::class,
			'text' => \Cake\Database\Type\StringType::class,
			'time' => \Cake\Database\Type\TimeType::class,
			'timestamp' => \Cake\Database\Type\DateTimeType::class,
			'uuid' => \Cake\Database\Type\UuidType::class,
		])
	);

	override(
		\Cake\View\View::element(0),
		map([
			'Common/Filter/multi-checkbox' => \Cake\View\View::class,
			'Common/modal' => \Cake\View\View::class,
			'Common/repairs' => \Cake\View\View::class,
			'Common/returns' => \Cake\View\View::class,
			'Flash/default' => \Cake\View\View::class,
			'Flash/error' => \Cake\View\View::class,
			'Flash/success' => \Cake\View\View::class,
			'Bootstrap.Flash/error' => \Cake\View\View::class,
			'Bootstrap.Flash/info' => \Cake\View\View::class,
			'Bootstrap.Flash/success' => \Cake\View\View::class,
			'Bootstrap.Flash/warning' => \Cake\View\View::class,
			'DebugKit.cache_panel' => \Cake\View\View::class,
			'DebugKit.environment_panel' => \Cake\View\View::class,
			'DebugKit.history_panel' => \Cake\View\View::class,
			'DebugKit.include_panel' => \Cake\View\View::class,
			'DebugKit.log_panel' => \Cake\View\View::class,
			'DebugKit.mail_panel' => \Cake\View\View::class,
			'DebugKit.packages_panel' => \Cake\View\View::class,
			'DebugKit.preview_header' => \Cake\View\View::class,
			'DebugKit.request_panel' => \Cake\View\View::class,
			'DebugKit.routes_panel' => \Cake\View\View::class,
			'DebugKit.session_panel' => \Cake\View\View::class,
			'DebugKit.sql_log_panel' => \Cake\View\View::class,
			'DebugKit.timer_panel' => \Cake\View\View::class,
			'DebugKit.variables_panel' => \Cake\View\View::class,
		])
	);

}
