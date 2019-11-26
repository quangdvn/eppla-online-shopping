(function() {
    let enterPressed = false;
    const searchClient = algoliasearch(
        "VGYGZLD5IE",
        "08ef944b22bafb7eda508b643fe26518"
    );
    const index = searchClient.initIndex("products");
    //initialize autocomplete on search input (ID selector must match)
    autocomplete(
        "#aa-search-input",
        { hint: true },
        {
            source: autocomplete.sources.hits(index, { hitsPerPage: 10 }),
            //value to be displayed in input control after user's suggestion selection
            displayKey: "name",
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function(suggestion) {
                    const markup = 
                    `
                        <div class="algolia-result">
                            <span>
                                <img src="${window.location.origin}/storage/${suggestion.image}" alt="img" class="algolia-thumb">
                                ${suggestion._highlightResult.name.value}
                            </span>
                            <span>$${(suggestion.price / 100).toFixed(2)}</span>
                        </div>
                        <div class="algolia-details">
                            <span>${
                                suggestion._highlightResult.details.value
                            }</span>
                        </div>
                    `;

                    return markup;
                },
                empty: function(result) {
                    return `Sorry, we did not find any results for ${result.query}`;
                }
            }
        }

        //* Go direct to the detail page
    ).on("autocomplete:selected", function(event, suggestion, dataset) {
        window.location.href = window.location.origin + "/shop/" + suggestion.slug;
        enterPressed = true;

        //* Go to the search result page
    }).on('keyup', (event) => {
        if (event.keyCode == 13 && !enterPressed) {
            let queryString = document.getElementById('aa-search-input').value
            window.location.href = window.location.origin + '/algoliasearch?query=' + queryString;
        }
    });
})();
