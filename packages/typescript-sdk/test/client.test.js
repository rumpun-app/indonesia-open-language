import test from 'node:test';
import assert from 'node:assert/strict';
import { IndonesiaOpenLanguage, ApiError } from '../src/index.js';
test('client sends bearer token and query parameters', async () => { const calls=[]; const client=new IndonesiaOpenLanguage({baseUrl:'https://api.example/api/v1',token:'secret',fetchImpl:async(url,options)=>{calls.push({url,options});return {ok:true,status:200,json:async()=>({data:[]})};}}); await client.dictionary.search('mangan',{language_id:'jv'}); assert.equal(calls[0].url,'https://api.example/api/v1/dictionary?language_id=jv&q=mangan'); assert.equal(calls[0].options.headers.Authorization,'Bearer secret'); });
test('client exposes structured API errors', async () => { const client=new IndonesiaOpenLanguage({baseUrl:'https://api.example',retries:0,fetchImpl:async()=>({ok:false,status:422,json:async()=>({message:'Invalid'})})}); await assert.rejects(()=>client.search('x'),(error)=>error instanceof ApiError&&error.status===422); });
