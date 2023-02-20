const fetch = require('node-fetch')

exports.handler = async function (event) {
    // Setup variables.
    const apiKey = process.env.SNOOPIKEY
    const iPToCheck = event.headers['x-nf-client-connection-ip'];

    // Make the request to Snoopi:
    const response = await fetch(`https://api.snoopi.io/${iPToCheck}?apikey=${apiKey}`)
    const data = await response.json();

    // Return what we get.
    return {
        statusCode: 200,
        headers: {
            "Access-Control-Allow-Origin": "*"// Can be changed to live site URL.
        },
        body: JSON.stringify({
            IP: iPToCheck,
            data: data,
            netlifyCountry: event.headers['x-country']
        })
    }
}