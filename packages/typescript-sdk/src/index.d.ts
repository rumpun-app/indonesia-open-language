export interface IndonesiaOpenLanguageOptions { baseUrl: string; token?: string; fetchImpl?: typeof fetch }
export declare class IndonesiaOpenLanguage {
  constructor(options: IndonesiaOpenLanguageOptions)
  languages: { list(): Promise<any>; get(id: string): Promise<any>; statistics(id: string): Promise<any> }
  dictionary: { search(q: string, params?: Record<string, string>): Promise<any>; get(id: string): Promise<any> }
  contributions: { list(): Promise<any>; create(payload: unknown): Promise<any>; submit(id: string): Promise<any> }
  learning: { courses(): Promise<any>; progress(): Promise<any>; recordProgress(payload: unknown): Promise<any> }
  search(q: string): Promise<any>
}
