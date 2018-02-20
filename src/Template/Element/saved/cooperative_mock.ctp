											         <a ng-show="cooperative.deleted==null" ng-click="turn_off_cooperative(cooperative)" class="dropdown-item">
															<abbr title="Cette action masquera cette zone dans la liste de sélecttion lors de la création d'une coopérative ou dans le cas d'une modification">Masquer la coopérative</abbr> 
												    </a>
											        <a ng-show="cooperative.deleted!==null" ng-click="turn_on_cooperative(cooperative)" class="dropdown-item">
																<abbr title="Cette action réaffichera cette zone dans la liste de sélecttion lors de la création d'une coopérative ou dans le cas d'une modification">Rendre visible la coopérative</abbr> 
													</a>