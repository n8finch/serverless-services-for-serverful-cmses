import { Context } from "https://edge.netlify.com";

export default async (request: Request, context: Context) => {
    return new Response(JSON.stringify({
            geo: context.geo
          }), {
        headers: { "content-type": "application/json", "Access-Control-Allow-Origin": "*" },
    });
};