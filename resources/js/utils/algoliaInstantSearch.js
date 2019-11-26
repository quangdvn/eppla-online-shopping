(function() {
    // Returns a slug from the category name.
    // Spaces are replaced by "+" to make
    // the URL easier to read and other
    // characters are encoded.
    function getCategorySlug(name) {
        return name
        .split(' ')
        .map(encodeURIComponent)
        .join('+');
    }

    // Returns a name from the category slug.
    // The "+" are replaced by spaces and other
    // characters are decoded.
    function getCategoryName(slug) {
        return slug
        .split('+')
        .map(decodeURIComponent)
        .join(' ');
    }

    const searchClient = algoliasearch(
        "VGYGZLD5IE",
        "08ef944b22bafb7eda508b643fe26518"
    );

    const search = instantsearch({
        indexName: "products",
        searchClient,
        routing: {
            router: instantsearch.routers.history({
                windowTitle({ category, query }) {
                    const queryTitle = query ? `Results for "${query}"` : 'Search';
        
                    // if (category) {
                    //     return `${category} – ${queryTitle}`;
                    // }
        
                    return queryTitle;
                },
        
                createURL({ qsModule, routeState, location }) {
                    const urlParts = location.href.match(/^(.*?)\/algoliasearch/);
                    const baseUrl = `${urlParts ? urlParts[1] : ''}/`;
        
                    // const categoryPath = routeState.category
                    //     ? `${getCategorySlug(routeState.category)}/`
                    //     : '';
                    const queryParameters = {};
        
                    if (routeState.query) {
                        queryParameters.query = encodeURIComponent(routeState.query);
                    }

                    if (routeState.page !== 1) {
                        queryParameters.page = routeState.page;
                    }

                    if (routeState.brands) {
                        queryParameters.brands = routeState.brands.map(encodeURIComponent);
                    }
        
                    const queryString = qsModule.stringify(queryParameters, {
                        addQueryPrefix: true,
                        // arrayFormat: 'repeat'
                    });
        
                // return `${baseUrl}algoliasearch/${categoryPath}${queryString}`;
                return `${baseUrl}algoliasearch${queryString}`;
                },
        
                parseURL({ qsModule, location }) {
                    const pathnameMatches = location.pathname.match(/algoliasearch\/(.*?)?$/);
                    // const category = getCategoryName(
                    //     (pathnameMatches && pathnameMatches[1]) || ''
                    // );

                    const { query = '', page, brands = [] } = qsModule.parse(
                        location.search.slice(1)
                    );
                
                    // `qs` does not return an array when there's a single value.
                    // const allBrands = Array.isArray(brands)
                    //     ? brands
                    //     : [brands].filter(Boolean);
        
                    return {
                        query: decodeURIComponent(query),
                        page,
                        // brands: allBrands.map(decodeURIComponent),
                        // category
                    };
                }
            }),
        
            stateMapping: {
                stateToRoute(uiState) {
                    const indexUiState = uiState['products'] || {};
        
                    return {
                        query: indexUiState.query,
                        page: indexUiState.page,
                        // brands: indexUiState.refinementList && indexUiState.refinementList.brand,
                        // category: indexUiState.menu && indexUiState.menu.categories
                    };
                },
        
                routeToState(routeState) {
                    return {
                        instant_search: {
                            query: routeState.query,
                            page: routeState.page,
                            menu: {
                                categories: routeState.category
                            },
                            refinementList: {
                                brand: routeState.brands
                            }
                        }
                    };
                }
            }
        }
    });

    search.addWidgets([
        instantsearch.widgets.searchBox({
            container: "#searchbox",
            placeholder: "Filter your wishes products here ..."
        }),

        instantsearch.widgets.hits({
            container: "#hits",
            templates: {
                empty: "No results",
                item: function(item) {
                    const markup = `
                        <a href="${window.location.origin}/shop/${item.slug}">
                            <div class="instantsearch-result">
                                <div>
                                    <img src="${window.location.origin}/storage/${item.image}" alt="img" class="algolia-thumb-result">
                                </div>
                                <div>
                                    <div class="result-title">
                                        ${item._highlightResult.name.value}
                                    </div>
                                    <div class="result-details">
                                        ${item._highlightResult.details.value}
                                    </div>
                                    <div class="result-price">
                                        $${(item.price / 100).toFixed(2)}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <hr>
                    `
                    return markup;
                }
            }
        }),

        instantsearch.widgets.pagination({
            container: "#pagination"
        }),

        instantsearch.widgets.stats({
            container: "#stats"
        }),

        instantsearch.widgets.refinementList({
            container: "#refinement-list",
            attribute: "categories"
        })
    ]);

    search.start();
})();
