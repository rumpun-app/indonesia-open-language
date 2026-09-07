export interface Page<T> { data: T[]; current_page?: number; last_page?: number; total?: number }
export interface Language { id: string; slug: string; name: string; native_name?: string; status?: string }
export interface LexicalEntry { id: string; language_id: string; status: string; word_forms?: unknown[]; senses?: unknown[] }
export interface Contribution { id: string; type: string; status: string; change_set: Record<string, unknown> }
export interface Course { id: string; slug: string; title: string; lessons?: unknown[] }
export interface IndonesiaOpenLanguageOptions { baseUrl: string; token?: string; fetchImpl?: typeof fetch; retries?: number }
export declare class ApiError extends Error { status: number; body: unknown; constructor(message: string, status: number, body: unknown) }
export declare class IndonesiaOpenLanguage {
 constructor(options: IndonesiaOpenLanguageOptions)
 languages: { list(params?: Record<string, unknown>): Promise<Page<Language>>; get(id:string):Promise<Language>; dialects(id:string):Promise<unknown>; scripts(id:string):Promise<unknown>; grammar(id:string):Promise<unknown>; statistics(id:string):Promise<unknown> }
 dictionary: { search(q:string,params?:Record<string,unknown>):Promise<Page<LexicalEntry>>; get(id:string):Promise<LexicalEntry>; create(payload:unknown):Promise<LexicalEntry> }
 contributions: { list(params?:Record<string,unknown>):Promise<Page<Contribution>>; get(id:string):Promise<Contribution>; create(payload:unknown):Promise<Contribution>; submit(id:string):Promise<Contribution>; publish(id:string):Promise<Contribution> }
 reviews: { list(params?:Record<string,unknown>):Promise<Page<unknown>>; create(payload:unknown):Promise<unknown> }; sources: { list(params?:Record<string,unknown>):Promise<Page<unknown>>; create(payload:unknown):Promise<unknown> }
 courses: { list(params?:Record<string,unknown>):Promise<Page<Course>>; get(id:string):Promise<Course> }; learning: { progress():Promise<unknown>; recordProgress(payload:unknown):Promise<unknown> }
 community: { posts(params?:Record<string,unknown>):Promise<Page<unknown>>; createPost(payload:unknown):Promise<unknown>; comment(id:string,payload:unknown):Promise<unknown>; report(payload:unknown):Promise<unknown> }
 audio: { list(params?:Record<string,unknown>):Promise<Page<unknown>>; upload(formData:FormData):Promise<unknown> }; moderation: { reports(params?:Record<string,unknown>):Promise<Page<unknown>>; resolveReport(id:string,payload:unknown):Promise<unknown> }
 analytics: { track(payload:unknown):Promise<unknown> }; tokens: { list():Promise<unknown>; create(payload:unknown):Promise<unknown>; revoke(id:string):Promise<void> }; exports: { languages(format?:'json'|'jsonl'|'csv'):Promise<unknown> }
 search(q:string):Promise<unknown>; ai:{query(query:string):Promise<unknown>}; reputation():Promise<unknown>; admin:{statistics():Promise<unknown>;auditLogs(params?:Record<string,unknown>):Promise<Page<unknown>>}
}
