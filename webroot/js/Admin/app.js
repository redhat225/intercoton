angular.module('intercoton',['ui.router','ngFileUpload','angular-loading-bar','ui.tinymce'])
	.run(['$rootScope','$templateCache','$transitions', function($rootScope, $templateCache,$transitions){
		
		$transitions.onStart({to:'admins.**'},function(trans){
			$rootScope.preloader = true;
		});	
		$transitions.onSuccess({to:'admins.**'},function(trans){
			$rootScope.preloader = false;
			$templateCache.removeAll();
		});	
	}])
	.config(['$httpProvider','$stateProvider','$urlRouterProvider','$locationProvider', function($httpProvider, $stateProvider, $urlRouterProvider, $locationProvider){
		$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
		$httpProvider.defaults.headers.common['Authorization'] = 'bearer '+localStorage.getItem('token');

		// Activate Html5 Mode + hashPrefix
		$locationProvider.html5Mode(true);
		$locationProvider.hashPrefix('!');

		// Routing 
		$stateProvider.state('admins',{
			url:'/',
			templateUrl: '/admins/home',
			controller: 'AdminsController as adminscontroller',
			abstract:true
		}).state('admins.dashboard',{
			url:'dashboard',
			templateUrl: '/admins/dashboard',
			controller: 'DashboardController as dashboardcontroller'
		}).state('admins.profile',{
			url:'profile',
			templateUrl: '/auditoraccounts/view',
			controller: 'ProfilesController as profilesctrl'
		}).state('admins.auditors', {
			url:'auditors/',
			templateUrl: '/auditors/',
			controller: 'AuditorsController as auditorsctrl'
		}).state('admins.auditors.create', {
			url: 'create',
			templateUrl: '/auditors/create',
			controller: 'AuditorsController as auditorsctrl'
		}).state('admins.auditors.edit', {
			url: 'edit/{auditor_id:int}',
			templateUrl: '/auditors/edit',
			controller: 'AuditorsController as auditorsctrl'
		}).state('admins.zones', {
			url:'zones/',
			templateUrl: '/zones/',
			controller: 'ZonesController as zonescontroller'
		}).state('admins.zones.create', {
			url:'create',
			templateUrl: '/zones/create',
			controller: 'ZonesController as zonescontroller'
		})
		.state('admins.zones.edit', {
			url:'edit/{zone_id:int}',
			templateUrl: '/zones/edit',
			controller: 'ZonesController as zonescontroller'
		}).state('admins.cooperatives', {
			url: 'cooperatives/',
			templateUrl: '/cooperatives/',
			controller: 'CooperativesController as cooperativesctrl'
		}).state('admins.cooperatives.create',{
			url: 'create',
			templateUrl: '/cooperatives/create',
			controller: 'CooperativesController as cooperativesctrl'
		}).state('admins.cooperatives.edit',{
			url: 'edit/{cooperative_id:int}',
			templateUrl: '/cooperatives/edit',
			controller: 'CooperativesController as cooperativesctrl'
		}).state('admins.sessions',{
			url: 'sessions/',
			templateUrl: '/sessions/',
			controller: 'SessionsController as sessionsctrl'
		}).state('admins.sessions.edit',{
			url: 'edit/{session_id:int}',
			templateUrl: '/sessions/edit',
			controller: 'SessionsController as sessionsctrl'
		}).state('admins.sessions.create',{
			url: 'create',
			templateUrl: '/sessions/create',
			controller: 'SessionsController as sessionsctrl'
		}).state('admins.reports',{
			url: 'reports/:session_id',
			templateUrl: '/reports/',
			controller: 'ReportsController as reportsctrl'
		}).state('admins.reports.create',{
			url: '/create',
			templateUrl: '/reports/create',
			controller: 'ReportsController as reportsctrl'
		}).state('admins.reports.edit',{
			url: '/edit/:report_id',
			templateUrl: '/reports/edit',
			controller: 'ReportsController as reportsctrl'
		})

		$urlRouterProvider.otherwise('/dashboard');
	}])
	.controller('AdminsController', ['$rootScope','$scope','ProfileService', function($rootScope,$scope,ProfileService){
		ProfileService.get_profile().then(function(resp){
			$rootScope.root_profile = resp.data.profile; 
			console.log(resp);
		}, function(){
			toastr.error('Une erreur est survenue lors du chargement des informations utilisateur');
		});

	}])
	.controller('SessionsController', ['$rootScope','$scope','SessionService','$state','$stateParams', function($rootScope,$scope,SessionService, $state, $stateParams){
		var self = this;
		$scope.load_all = function(){
			SessionService.all().then(function(resp){
				    $rootScope.sessions = resp.data.sessions;
				    $scope.filter_keys ='';
		            $scope.default_sessions_order = ['+created'];
			}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
			});
		};
		$scope.load_all();

		$scope.create = function(session){
			$scope.is_loading = true;
			SessionService.create(session).then(function(resp){
				toastr.success('Session créée avec succès');
				$scope.load_all();
				$state.go('admins.sessions');
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			}).finally(function(){
			    $scope.is_loading = false;
			});
		};


		$scope.update = function(session){
			$scope.is_loading = true;
			SessionService.update(session).then(function(resp){
				toastr.success('Changements réalisés avec succès');
				$scope.load_all();
				$state.go('admins.sessions');
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			}).finally(function(){
				$scope.is_loading = false;
			});
		};

		if($stateParams.session_id){
			SessionService.get($stateParams.session_id).then(function(resp){
				$scope.session_update = resp.data.session;
				$scope.session_update.session_begin_date = new Date($scope.session_update.session_begin_date);
				$scope.session_update.session_end_date = new Date($scope.session_update.session_end_date);
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			})
		}

	}])
	.controller('ProfilesController', ['$scope','ProfileService', function($scope,ProfileService){
		$scope.get_profile = function(){
			ProfileService.get_profile().then(function(resp){
			    $scope.profile = resp.data.profile;
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			});
		};
		$scope.get_profile();
		var self = this;
		$scope.delete_auditor_photo_candidate = function(){
			self.is_changing_image = false;
			delete $scope.profile.account_avatar_candidate;
		};

		$scope.update = function(){
			$scope.is_loading = true;
			ProfileService.update_profile($scope.profile).then(function(resp){
				toastr.success('Vos informations ont été modifiées, veuillez vous reconnecter pour constater les changements')
			}, function(err){
				toastr.error('une erreur est survenu, veuillez réessayers');
			}).finally(function(){
				$scope.is_loading = false;
			});
		};

	}])
	.controller('DashboardController', ['$scope', function($scope){

	}])
	.controller('MapsController', ['$scope', function($scope){
		var self = this;
	}])
	.controller('CooperativesController', ['$rootScope','$scope','ZoneService','$compile','$templateCache','CooperativeService','$state','$stateParams', function($rootScope,$scope,ZoneService,$compile,$templateCache,CooperativeService,$state,$stateParams){
		$scope.is_loading = false;
		$scope.opa={};
		$scope.currenTab = 'tabular';

		// Controller section for cooperative view
		$scope.load_cooperatives = function(){
			CooperativeService.all().then(function(resp){
				$rootScope.cooperatives = resp.data.cooperatives;
				$scope.filter_keys ='';
		        $scope.default_cooperative_order = ['+cooperative_denomination'];
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			});
		};
		$scope.load_cooperatives();

		// controller section edit cooperative
		if($stateParams.cooperative_id){
				CooperativeService.edit($stateParams.cooperative_id).then(function(resp){
				$scope.opa_edit = resp.data.cooperative;
				let geoloc = JSON.parse($scope.opa_edit.cooperative_geoloc);
				$scope.opa_edit.cooperative_latitude = parseInt(geoloc.latitude);
				$scope.opa_edit.cooperative_longitude = parseInt(geoloc.longitude);
	 
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			});
		}


		$scope.delete_photo_cooperative_change = function(){
			$scope.opa_edit.is_changing_image = false;
			$scope.opa_edit.main_photo_candidate = null;
		};

		$scope.edit = function(){
			$scope.is_loading = true;
			CooperativeService.modify($scope.opa_edit).then(function(resp){
				toastr.success('coopérative modifiée avec succès');
				$scope.load_cooperatives();
				$state.go("admins.cooperatives");
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			}, function(evt){
				console.log(evt);
			}).finally(function(){
				$scope.is_loading = false;
			});	
		};

		$scope.set_cooperative_state = function(is_deleted){
			let type = typeof(is_deleted);
			if(type=='string')
				return 'intercoton-yellow-b';
			else
				return '';
		};

		// controller section for creating new cooperative
		ZoneService.all().then(function(resp){	
			$scope.zones = resp.data.zones;
		}, function(err){
			toastr.error('Une erreur est survenue, veuillez réessayer');
		});

		$scope.addItemImageOpa = function(){
			  childScope_cooperative = $scope.$new();
			  var recursiveFields = $("<div photo-opa-item-directive></div>");
			  recursiveFields.insertAfter('#additional_images');
			  $compile(recursiveFields)(childScope_cooperative);
			  $templateCache.removeAll();
		};

		$scope.create = function(){
			$scope.is_loading = true;
			CooperativeService.create($scope.opa).then(function(resp){
				toastr.success('Coopérative enregistrée');
				$scope.load_cooperatives();
				$state.go('admins.cooperatives');
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			}, function(evt){

			}).finally(function(){
				$scope.is_loading = false;
			});
		};
		$scope.turn_off_cooperative = function(cooperative){
			var r = confirm("êtes-vous sûre de vouloir masquer la coopérative "+cooperative.cooperative_denomination);
			if(r==true){
				CooperativeService.turn_off(cooperative.id).then(function(resp){
					cooperative.deleted = resp.data.cooperative.deleted.date;
					toastr.success('Changement effectué avec succès');
				}, function(err){
					toastr.error('Une Erreur est survenue, veuillez réessayer');
				});
			}

		};
		$scope.turn_on_cooperative = function(cooperative){
		var r = confirm("êtes-vous sûre de vouloir rendre visible la coopérative "+cooperative.cooperative_denomination);
		if(r==true){
				CooperativeService.turn_on(cooperative.id).then(function(resp){
					cooperative.deleted = null;
					toastr.success('Changement effectué avec succès');
				}, function(err){
					toastr.error('Une Erreur est survenue, veuillez réessayer');
				});
			}

		};


	}])
	.controller('ZonesController', ['$rootScope','$scope','ZoneService','$state','$stateParams','$compile','$templateCache', function($rootScope,$scope,ZoneService,$state,$stateParams,$compile,$templateCache){
		$scope.current_state = $state.current.name;
		$scope.zone = {
			zone_denomination: ''
		};
		$scope.create = function(){
			$scope.is_loading = true;
			ZoneService.create($scope.zone).then(function(resp){
				toastr.success('zone(s) créée(s) avec succès');
				$scope.all();
				$state.go('admins.zones');
			}, function (err){
				toastr.warning('Une erreur est survenue, veuillez réessayer');
			}).finally(function(){
				$scope.is_loading = false;
			});
		};
		$scope.all = function(){
			ZoneService.all().then(function(resp){
				$rootScope.zones = resp.data.zones;
				$scope.filter_keys ='';
		        $scope.default_zone_order = ['+zone_denomination'];
			}, function(err){
				toastr.error("Les zones n'ont pas pu être chargées, veuillez recharger la page");
			});
		}

		$scope.get = function(zone_id){
			ZoneService.get(zone_id).then(function(resp){
				$scope.zone = resp.data.zone;
			}, function(err){
				toastr.error("La zone n'a pas pu être chargée, veuillez recharger la page");
			});
		}

		$scope.edit = function(zone){
			ZoneService.edit(zone).then(function(resp){
				toastr.success('Zone modifiée');
				$scope.all();
				$state.go('admins.zones');
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			});
		};
		$scope.turn_off_zone = function(zone_id){
			ZoneService.desactivate_zone(zone_id).then(function(resp){
				$scope.all();
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');	
			});
		};
		$scope.turn_on_zone = function(zone_id){
			ZoneService.activate_zone(zone_id).then(function(resp){
				$scope.all();
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');	
			});
		};

		switch($scope.current_state)
		{
			case 'admins.zones':
				$scope.all();
			break;

			case 'admins.zones.edit':
				$scope.get($stateParams.zone_id);
			break;
		}

		//add item-element-zone
		$scope.addItemZone = function(){
			  childScope = $scope.$new();
			  var recursiveFields = $("<div zone-item-directive></div>");
			  recursiveFields.insertAfter('#main-zone-item');
			  $compile(recursiveFields)(childScope);
			  $templateCache.removeAll();
		};
	}])
	.controller('AuditorsController', ['$rootScope','$scope','Upload','$state','AuditorService','$location','$stateParams', function($rootScope,$scope,Upload, $state, AuditorService, $location, $stateParams){
		//controller section manage all auditors
		$scope.is_loading = false;

		$scope.load_auditors = function(){
			AuditorService.all().then(function(resp){
				$rootScope.auditors = resp.data.auditors;
				$scope.filter_keys ='';
		        $scope.default_auditor_order = ['+auditor_fullname'];
			}, function(err){
				toastr('Une erreur est survenue lors du chargement, veuillez recharger la page');
			});
		};

		$scope.load_auditors();

		$scope.upload = function(auditor){
			$scope.is_loading = 'is-loading';
			Upload.upload({
				url: '/auditors/create',
				data: {file: auditor}
			}).then(function(resp){
                  toastr.success('Enregistrement réussi');
                  $state.go('admins.auditors');
			}, function(err){
                  toastr.error('Une erreur est survenue, veuillez réessayer');
			}, function(evt){

			}).finally(function(){
				$scope.is_loading = 'none';
			});
		};

		$scope.reset_form = function(){
			$state.go('admins.auditors');
		};

		// Turn off/on account
		$scope.turn_off_account = function(id_account){
			$scope.is_loading = 'is-loading';
			let r = confirm("êtes-vous sûre de vouloir désactiver ce compte ?");
			if(r==true){
				AuditorService.turn_off_account(id_account).then(function(resp){
					toastr.success('Action réalisée avec succès');
				}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
				}).finally(function(){
				     $scope.is_loading = 'none';
				});
			}

		};
		$scope.turn_on_account = function(id_account){
			$scope.is_loading = 'is-loading';
			let r = confirm("êtes-vous sûre de vouloir réactiver ce compte?");
			if(r==true){
				AuditorService.turn_on_account(id_account).then(function(resp){
					toastr.success('Action réalisée avec succès');
				}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
				}).finally(function(){
				     $scope.is_loading = 'none';
				});
			}

		};

		$scope.soft_delete = function(id_account){
			let r = confirm("êtes-vous sûre de vouloir supprimer ce compte?");
			if(r==true){
				$scope.is_loading = 'is-loading';
				AuditorService.soft_delete(id_account).then(function(resp){
					toastr.success('Action réalisée avec succès');
					location.reload();
				}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
				}).finally(function(){
				     $scope.is_loading = 'none';
				});
			}

		};
		$scope.reinit_account = function(id_account){
			let r = confirm('êtes-vous sure de vouloir réinitialiser ce compte? le mot de passe par défaut sera Intercoton@2018')
			if(r==true){
				self.is_loading = 'is-loading';
				AuditorService.reinit_account(id_account).then(function(resp){
					toastr.success('Action réalisée avec succès');
					location.reload();
				}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
				}).finally(function(){
				     self.is_loading = 'none';
				});
			}

		}

		//controller section for editing account
		  

		if($stateParams.auditor_id){
			AuditorService.account_info($stateParams.auditor_id).then(function(resp){
				$scope.auditor = resp.data.auditor;
				$scope.auditor.auditor_accounts[0].role_id = $scope.auditor.auditor_accounts[0].role_id.toString();
				 self.is_changing_image = false;
			}, function(err){
				toastr.warning('Une erreur est survenue, veuillez réessayer');
			});
		}

		$scope.delete_auditor_photo_candidate = function(){
			self.is_changing_image = false;
			$scope.auditor.auditor_photo_candidate = null;
		};	
		$scope.update = function(auditor){
			$scope.is_loading = true;
			Upload.upload({
				url:'/auditors/edit',
				data:{file:auditor}	
			}).then(function(resp){
				toastr.success('Action réussie');
				$scope.load_auditors();
				$state.go('admins.auditors');
			}, function(err){
				toastr.success('Une erreur est survenue, veuillez réessayer');
			}, function(evt){

			}).finally(function(){
				self.is_loading = false;
			});
		};	
	}])
	.controller('ReportsController', ['$scope','ReportService','$stateParams','$state','CooperativeService','$compile','$templateCache', function($scope,ReportService,$stateParams,$state,CooperativeService,$compile,$templateCache){
		var $state_url = $state.current.url;
		console.log($state_url);
		if($state_url === '/create')
		{
			$scope.session_id = $stateParams.session_id;
			// load cooperatives
			CooperativeService.all().then(function(resp){
				$scope.cooperatives = resp.data.cooperatives;

				$scope.report = {
					session_id: $stateParams.session_id,
					cooperative_id: $scope.cooperatives[0].id,
					reports: {}
				};
			}, function(err){
				toastr.error('Une erreur est survenue, veuillez réessayer');
			});

			$scope.addItemReport = function(){
				  childScope = $scope.$new();
				  var recursiveFields = $("<div report-item-directive></div>");
				  recursiveFields.insertAfter('#report_title');
				  $compile(recursiveFields)(childScope);
				  $templateCache.removeAll();
			};

			$scope.create = function(){
				ReportService.create($scope.report).then(function(resp){
					toastr.success('Rapport enregistré avec succès');
					$state.go('admins.reports',{session_id:$scope.report.session_id},{reload:true});
				}, function(err){
					toastr.error('Une erreur est survenue, veuillez réessayer');
				});
			};

			$scope.tinymceOptions = {
			    plugins: 'link image code lists advlist',
			    toolbar: 'undo redo numlist bullist| bold italic| alignleft aligncenter alignright | code'
			};

		}

		if($state_url ==="reports/:session_id")
		{
			alert('yes');
		}



	}]).factory('ReportService',['$http','$q','Upload', function($http,$q,Upload){
		return{
			view: function(id){
				return $http.all('/reports',{params:{session_id:id, action:'get-report'}}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			create: function(report){
				return Upload.upload({
					url:'/reports/create',
					data: report
				}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				}, function(evt){
					return evt;
				});
			}
		}
	}])
	.factory('SessionService',['$http','$q', function($http,$q){
		return{
			all: function(){
				return $http.get('/sessions',{params:{action:'get-all'}}).then(function(resp){
					return resp;
				}, function(err){
					  return $q.reject(err);
				});
			},
			create: function(session){
				return $http.post('/sessions/create', session).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				})
			},
			update: function(session){
				return $http.put('/sessions/edit', session).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				})
			},
			get: function(session_id){
				return $http.get('/sessions/get', {params:{id:session_id}}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				})
			}
		}
	}])
	.factory('AuditorService', ['$http', '$q', function($http,$q){
		return {
			all: function(){
				return $http.get('/auditors',{params:{action:'get-auditors'}}).then(function(resp){
					return resp;
				}, function(err){	
					return $q.reject(err);
				});
			},
			turn_off_account : function(id_account){
				return $http.put('/auditors/edit', {action:'turn_off', account:id_account}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			turn_on_account : function(id_account){
				return $http.put('/auditors/edit', {action:'turn_on', account:id_account}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			soft_delete : function(id_account){
				return $http.put('/auditors/edit', {action:'soft_delete', account:id_account}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			reinit_account: function(id_account){
				return $http.put('/auditors/edit', {action:'reinitialisation', account:id_account}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			account_info: function(id_account){
				return $http.get('/auditors/edit',{params:{account:id_account}}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
		};
	}]).factory('ZoneService', ['$http', '$q', function($http,$q){
		return {
			create: function(zone){
				return $http.post('/zones/create', zone).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err)
				});
			},
			all: function(){
				return $http.get('/zones/', {params:{action:'all'}}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			get: function(zone_id){
				return $http.get('/zones/edit',{params:{id:zone_id,action:"edit-zone"}}).then(function(resp){
					return resp
				}, function(err){
					return $q.reject(err);
				});
			},
			edit: function(zone_selected){
				return $http.post('/zones/edit', {zone:zone_selected, action:'edit-zone'}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err)
				});
			},
			addZone: function(){
				return $http.get('/zones/create-zone-template').then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err)
				});
			},
			activate_zone: function(zone_selected){
				return $http.post('/zones/edit',{zone:zone_selected, action:'activate_zone'}).then(function(resp){
    				return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			desactivate_zone: function(zone_selected){
				return $http.post('/zones/edit',{zone:zone_selected, action:'desactivate_zone'}).then(function(resp){
    				return resp;
				}, function(err){
					return $q.reject(err);
				});
			}

		};
	}]).factory('CooperativeService',['$http','$q','Upload', function($http,$q,Upload){
		return {
			create: function(cooperative_item){
				return Upload.upload({
					url:'/cooperatives/create',
					data: {cooperative: cooperative_item, action:'create'}
				}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				}, function(evt){
					return evt;
				});
			},
			all: function(){
				return $http.get('/cooperatives/',{params:{action:'get'}}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			edit: function(id){
				return $http.get('/cooperatives/edit',{params:{cooperative_id:id,action:'edit'}}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			modify: function(cooperative_item){
				return Upload.upload({
					url: '/cooperatives/edit',
					data: {cooperative: cooperative_item, action:'modify'}
				}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				}, function(evt){
					return evt;
				});
			},
			turn_off: function(cooperative_id){
				return $http.put('/cooperatives/edit',{cooperative:cooperative_id,action:'turn_off'}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			},
			turn_on: function(cooperative_id){
				return $http.put('/cooperatives/edit',{cooperative:cooperative_id,action:'turn_on'}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});
			}
		}
	}]).factory('ProfileService',['$http','$q','Upload', function($http,$q,Upload){
		return{
			get_profile: function(){
				return $http.get('/auditoraccounts/view',{params:{action:'get-profile'}}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				});			
			},
			update_profile: function(profile_object){
				return Upload.upload({
					url: '/auditoraccounts/update',
					data: {profile:profile_object,action:'update-profile-self'}
				}).then(function(resp){
					return resp;
				}, function(err){
					return $q.reject(err);
				}, function(evt){
					 return evt;
				});
			}
		};
	}])
	.directive('zoneItemDirective', function(){
    return {
        templateUrl: '/zones/create-zone-template',
        link: function(scope, el, attrs){
            scope.destroy_item_zone = function(zone_id,zone_to_remove){
            	delete scope.zone[zone_to_remove];
	            scope.$destroy();
	            angular.element(zone_id).remove();
            }

        }
    }
}).directive('photoOpaItemDirective', function(){
    return {
        templateUrl: '/cooperatives/add-image-opa-item',
        link: function(scope, el, attrs){
            scope.destroy_item_opa_image_item = function(item_id,item_to_remove){
            	if(scope.opa.photos_add)
            	{
	            	if(scope.opa.photos_add[item_to_remove])
            	     delete scope.opa.photos_add[item_to_remove];
            	}
	            scope.$destroy();
	            angular.element(item_id).remove();
            }

        }
    }
}).directive('reportItemDirective', function(){
    return {
        templateUrl: '/reports/add-item-report',
        link: function(scope, el, attrs){

			scope.tinymceOptions = {
			    plugins: 'link image code lists advlist',
			    toolbar: 'undo redo numlist bullist| bold italic| alignleft aligncenter alignright | code'
			};

            scope.destroy_item_report= function(item_id,item_ref){
            	console.log(item_ref);
            	console.log(scope.report.reports);
            	if(scope.report.reports[item_ref])
            	{
	            	if(scope.report.reports[item_ref])
            	     delete scope.report.reports[item_ref];
            	}
	            scope.$destroy();
	            angular.element(item_id).remove();
            }

        }
    }
})
